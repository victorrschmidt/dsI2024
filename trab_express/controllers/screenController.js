const { sequelize, Sequelize } = require('../config/database');
const { departments, currencyFormat } = require('../lib/utilities');
const employeeModel = require('../models/employee')(sequelize, Sequelize);

exports.employees = (req, res) => {
    employeeModel.findAll({
        order: [['id', 'ASC']]
    }).then((results) => {
        if (results.length !== 0) {
            for (let i = 0; i < results.length; i++) {
                let dep_id = results[i]['department'];
                results[i]['department'] = `${dep_id} - ${departments[dep_id]}`;
                results[i]['brute_salary'] = currencyFormat(results[i]['brute_salary']);
                results[i]['liquid_salary'] = currencyFormat(results[i]['liquid_salary']);
            }
        }    

        res.render('employees', { layout: false, employees: results })
    }).catch(err => {
        res.status(500).send({ message: `Error: ${err.message}` })
    })
};

exports.management = (req, res) => {
    employeeModel.findAll({
        order: [['id', 'ASC']]
    }).then((results) => {
        if (results.length !== 0) {
            for (let i = 0; i < results.length; i++) {
                let dep_id = results[i]['department'];
                results[i]['department'] = `${dep_id} - ${departments[dep_id]}`;
            }
        }    

        res.render('management', { layout: false, employees: results })
    }).catch(err => {
        res.status(500).send({ message: `Error: ${err.message}` })
    })
};

exports.insert = (req, res) => {
    res.render('insert', { layout: false });
};

exports.edit = (req, res) => {
    const id_param = req.params.id;
    console.log(id_param);

    employeeModel.findOne({
        where: { id: id_param }
    }).then((result) => {
        res.render('edit', { layout: false, employee: result })
    }).catch(err => {
        res.status(500).send({ message: `Error: ${err.message}` })
    })
};