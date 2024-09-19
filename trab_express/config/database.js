const db = {
    name: 'empresa',
    root: 'root',
    password: '',
    host: '127.0.0.1'
};

const Sequelize = require('sequelize');

const sequelize = new Sequelize(db.name, db.root, db.password, {
    host: db.host,
    dialect: 'mysql'
});

module.exports = {
    Sequelize,
    sequelize
};