const express = require('express');
const router = express.Router();
var screenController = require('../controllers/screenController');
var functionController = require('../controllers/functionController');

// Telas
router.get('/', screenController.employees);
router.get('/cadastrar', screenController.insert);
router.get('/editar/:id', screenController.edit);

// Funções
router.post('/cadastrar', functionController.insert);
router.post('/editar/:id', functionController.edit);
router.get('/deletar/:id', functionController.delete);

module.exports = router;