const { allowInsecurePrototypeAccess } = require('@handlebars/allow-prototype-access');

const express = require('express');
const handlebars = require('handlebars');
const handlebars_mod = require('express-handlebars');

const appRoutes = require('./routes/approutes');
const app = express();

app.use(express.urlencoded({ extended: false }));
app.use(express.json());
app.set('view engine', 'handlebars');
app.use(appRoutes);

app.engine('handlebars', handlebars_mod.engine({
    handlebars: allowInsecurePrototypeAccess(handlebars)
}));

app.listen(3000, () => {
    console.log('Server running at localhost:3000');
});