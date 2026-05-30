const { GraphQLObjectType, GraphQLString, GraphQLFloat, GraphQLInt, GraphQLBoolean, GraphQLSchema, GraphQLList, GraphQLNonNull } = require('graphql');
const { Habitacion } = require('./database');

// Tipo de Dato
const HabitacionType = new GraphQLObjectType({
  name: 'Habitacion',
  fields: {
    codHabitacion: { type: GraphQLString },
    tipo: { type: GraphQLString },
    capacidad: { type: GraphQLInt },
    tarifa: { type: GraphQLFloat },
    disponible: { type: GraphQLBoolean }
  }
});

// Consulta (Query)
const RootQuery = new GraphQLObjectType({
  name: 'RootQueryType',
  fields: {
    habitacion: {
      type: HabitacionType,
      args: { codHabitacion: { type: GraphQLString } },
      resolve(parent, args) {
        return Habitacion.findByPk(args.codHabitacion);
      }
    }
  }
});

// Mutación para reservar (actualizar disponibilidad)
const Mutation = new GraphQLObjectType({
  name: 'Mutation',
  fields: {
    actualizarDisponibilidad: {
      type: HabitacionType,
      args: {
        codHabitacion: { type: new GraphQLNonNull(GraphQLString) }
      },
      resolve(parent, args) {
        return Habitacion.findByPk(args.codHabitacion)
          .then(habitacion => {
            if (!habitacion) {
              throw new Error('Habitación no encontrada en Mirador Andino');
            }
            if (habitacion.disponible == 0 || habitacion.disponible == false) {
                throw new Error('La habitación ya está ocupada');
            }
            // Cambiamos el estado a No Disponible (0)
            return habitacion.update({
              disponible: false
            });
          });
      }
    }
  }
});

module.exports = new GraphQLSchema({
  query: RootQuery,
  mutation: Mutation
});