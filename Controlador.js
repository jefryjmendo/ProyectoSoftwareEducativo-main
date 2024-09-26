const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const path = require('path');
const bcrypt = require('bcrypt');
const session = require('express-session');
const MySQLStore = require('express-mysql-session')(session);

const app = express();
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Sirve archivos estáticos desde el directorio public
app.use(express.static(path.join(__dirname, 'public')));

const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'proyectocarrera'
});

const sessionStore = new MySQLStore({}, pool);

app.use(session({
    key: 'session_cookie_name',
    secret: 'session_cookie_secret',
    store: sessionStore,
    resave: false,
    saveUninitialized: false
}));

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

app.post('/api/register', (req, res) => {
  const nombre = req.body.username;
  const password = req.body.password;
  const email = req.body.email;
  const role = req.body.role;

  bcrypt.hash(password, 10, function(err, hash) {
    pool.query('INSERT INTO usuarios (nombre, password, email, role) VALUES (?, ?, ?, ?)', [nombre, hash, email, role], function(error, results) {
      if (error) throw error;
      res.redirect('/');
    });
  });
});

app.post('/api/login', (req, res) => {
  const nombre = req.body.username;
  const password = req.body.password;

  pool.query('SELECT * FROM usuarios WHERE nombre = ?', [nombre], function(error, results) {
    if (error) throw error;

    if (results.length > 0) {
      bcrypt.compare(password, results[0].password, function(err, result) {
        if(result == true) {
          // Guardar la sesión del usuario
          req.session.usuario = results[0];
          if(req.session.usuario.role === 'docente') {
            res.render('Docentes', { docente: req.session.usuario, estudiantes: results });
          } else {
            res.render('Estudiantes', { estudiante: req.session.usuario });
          }
        } else {
          res.redirect('/');
        }
      });
    } else {
      res.send('Usuario no encontrado!');
    }
  });
});

app.get('/api/logout', function(req, res){
   req.session.destroy(function(err){
      if(err){
         console.log(err);
      } else {
         res.redirect('/');
      }
   });
});

app.get('/api/Docentes/CuentasEstudiantes', function(req, res) {
  if (req.session.usuario && req.session.usuario.role === 'docente') {
    pool.query('SELECT * FROM usuarios WHERE role = ? ORDER BY nombre DESC, email DESC', ['estudiante'], function(error, results) {
      if (error) throw error;
      res.render('CuentasEstudiantes', { estudiantes: results });
    });
  } else {
    res.redirect('/');
  }
});

app.get('/api/Docentes/Temas', function(req, res) {
  if (req.session.usuario && req.session.usuario.role === 'docente') {
    pool.query('SELECT * FROM temas WHERE docente_id = ?', [req.session.usuario.id], function(error, temas) {
      if (error) throw error;
      if (temas.length) { // Comprueba si la consulta devolvió resultados
        res.render('Temas', { temas: temas });
      } else {
        res.render('Temas', { temas: [] }); // Si no, pasa una lista vacía a la vista Temas
      }
    });
  } else {
    res.redirect('/');
  }
});


app.get('/api/Docentes/Examenes', function(req, res) {
  if (req.session.usuario && req.session.usuario.role === 'docente') {
    pool.query('SELECT * FROM tests INNER JOIN preguntas ON tests.id = preguntas.test_id', function(error, examenes) {
      if (error) throw error;
      res.render('Examenes', { examenes: examenes });
    });
  } else {
    res.redirect('/');
  }
});

app.get('/api/Docentes/RendimientoEstudiantes', function(req, res) {
  if (req.session.usuario && req.session.usuario.role === 'docente') {
    pool.query('SELECT * FROM resultados_tests INNER JOIN usuarios ON resultados_tests.usuario_id = usuarios.id', function(error, resultados) {
      if (error) throw error;
      res.render('RendimientoEstudiantes', { resultados: resultados });
    });
  } else {
    res.redirect('/');
  }
});


app.listen(3000, () => {
  console.log('Server is running on port 3000');
});
