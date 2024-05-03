const mongoose = require('mongoose');
const User = mongoose.model('User');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const jwtSecret = 'your_jwt_secret';

exports.renderRegisterForm = (req, res) => {
  res.render('register');
};

exports.registerUser = async (req, res) => {
  try {
    const { userName, password, confirmPassword } = req.body;
    if (!userName || !password || password !== confirmPassword) {
      return res.status(400).json({ message: 'Invalid input' });
    }

    const existingUser = await User.findOne({ userName });
    if (existingUser) {
      return res.status(400).json({ message: 'User already exists' });
    }

    const hashedPassword = await bcrypt.hash(password, 10);
    const user = new User({ userName, password: hashedPassword });
    await user.save();

    const maxAge = 3 * 60 * 60; // 3 hours
    const token = jwt.sign({ id: user._id, userName }, jwtSecret, {
      expiresIn: maxAge,
    });

    res.cookie('jwt', token, { httpOnly: true, maxAge: maxAge * 1000 });
    res.redirect('/?auth=' + true + '&userId=' + user._id);
  } catch (error) {
    res
      .status(500)
      .json({ message: 'Failed to register user', error: error.message });
  }
};

exports.renderLoginForm = (req, res) => {
  res.render('login');
};

exports.loginUser = async (req, res) => {
  try {
    const { userName, password } = req.body;
    const user = await User.findOne({ userName });

    if (!user || !(await bcrypt.compare(password, user.password))) {
      return res
        .status(400)
        .json({ message: 'Invalid username or password' });
    }

    const maxAge = 3 * 60 * 60; // 3 hours
    const token = jwt.sign({ id: user._id, userName }, jwtSecret, {
      expiresIn: maxAge,
    });

    res.cookie('jwt', token, { httpOnly: true, maxAge: maxAge * 1000 });
    res.redirect('/?auth=' + true + '&userId=' + user._id);
  } catch (error) {
    res
      .status(500)
      .json({ message: 'Failed to login user', error: error.message });
  }
};

exports.logoutUser = (req, res) => {
  res.clearCookie('jwt');
  res.redirect('/');
};

