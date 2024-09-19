const { sequelize, Sequelize } = require('../config/database');
const { liquidSalaryCalculator } = require('../lib/utilities');
const employeeModel = require('../models/employee')(sequelize, Sequelize);

exports.insert = (req, res) => {
    const employeeData = {
        name: req.body.name.trim(),
        brute_salary: req.body.salary,
        liquid_salary: liquidSalaryCalculator(req.body.salary),
        department: req.body.department
    };

    employeeModel.create(employeeData).then((data) => {
        res.redirect('/');
    }).catch((err) => {
        console.log(`Error: ${err}`);
    })
};

exports.delete = (req, res) => {
    const id_param = req.params.id;

    employeeModel.destroy({
        where: { id: id_param }
    }).then((result) => {
        if (!result) {
            req.status(400).json({
                message: 'An error occured...'
            })
        }
        
        res.redirect('/');
    }).catch((err) => {
        res.status(500).json({
            message: 'Could not delete such object.'
        })
        console.log(err);
    });
};

exports.edit = (req, res) => {
    const id_param = req.params.id;

    const employeeData = {
        name: req.body.name.trim(),
        brute_salary: req.body.salary,
        liquid_salary: liquidSalaryCalculator(req.body.salary),
        department: req.body.department
    };

    employeeModel.update(
        employeeData,
        { where: { id: id_param } }
    ).then((result) => {
        if (!result) {
            req.status(400).json({
                message: 'An error occured...'
            })
        }

        res.redirect('/');
    }).catch((err) => {
        res.status(500).json({
            message: 'Could not delete such object.'
        })
        console.log(err);
    });
};