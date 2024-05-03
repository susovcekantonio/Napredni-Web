var createError = require('http-errors');
var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');

var indexRouter = require('./routes/index');
var usersRouter = require('./routes/userRoutes');
const mongoose = require('mongoose');

var app = express();


mongoose.connect('mongodb://127.0.0.1:27017/projects', {
})
.then(() => console.log('Connected to MongoDB'))
.catch(err => console.error('Error connecting to MongoDB:', err));


app.use(express.json());
app.use(express.static('public'));
app.use('/', indexRouter);
app.use('/users', usersRouter);

app.listen(61505, () => {
  console.log('Server is running on port 61505');
});

module.exports = app;