const { Sequelize } = require('sequelize');

const sequelize = new Sequelize('bd_mirador_andino', 'root', '', {
  host: 'localhost',
  dialect: 'mysql'
});


const Habitacion = sequelize.define('Habitacion', {
  codHabitacion: {
    type: Sequelize.STRING(20),
    allowNull: false,
    primaryKey: true
  },
  tipo: {
    type: Sequelize.STRING(50),
    allowNull: false
  },
  capacidad: {
    type: Sequelize.INTEGER,
    allowNull: false
  },
  tarifa: {
    type: Sequelize.DOUBLE,
    allowNull: false
  },
  disponible: {
    type: Sequelize.BOOLEAN,
    allowNull: false,
    defaultValue: true
  }
}, {
  tableName: 'habitacions', // Coincidimos con el nombre de tabla por si acaso
  timestamps: false
});

module.exports = { sequelize, Habitacion };
