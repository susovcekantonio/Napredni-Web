const express = require('express');
const router = express.Router();
const userController = require('../controllers/userController');

router.post('/registers', userController.registerUser);

module.exports = router;
