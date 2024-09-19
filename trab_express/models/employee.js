const { sequelize } = require('../config/database');

module.exports = (sequelize, DataTypes) =>
{
    var Employees = sequelize.define('employees',
        {
            id: {
                type: DataTypes.BIGINT(20),
                primaryKey: true,
                autoIncrement: true
            },
            name: {
                type: DataTypes.STRING
            },
            brute_salary: {
                type: DataTypes.DOUBLE
            },
            liquid_salary: {
                type: DataTypes.DOUBLE
            },
            department: {
                type: DataTypes.INTEGER
            }
        }, 
        {
            timestamps: false
        }
    );

    Employees.sync({ force: true });

    return Employees;
}