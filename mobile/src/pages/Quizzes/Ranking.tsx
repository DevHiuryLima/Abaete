import React, { useEffect, useState } from 'react';
import { Image, ScrollView, View, StyleSheet, Text } from 'react-native';
import { useNavigation, useRoute } from '@react-navigation/native';

import api from '../../services/api';
import level from '../../images/Quiz/level.png';

interface Competidores {
  idPontoUsuario: number;
  usuario: {
    idUsuario: number;
    nome: string;
    imagem: string;
    email: string;
  }
  pontos: string;
  url: string;
}

export default function Ranking() {
  const [competidores, setCompetidores] = useState<Competidores[]>([]);
  const navigation = useNavigation();
  let posicao=0;

  useEffect(() => {
    api.get('ranking').then(response => {
      // console.log(response.data);
      setCompetidores(response.data);
    }).catch((error) => {
      console.log(error);
    })
  }, []);

  if(!competidores) return (
    <View style={styles.container}>
      <Text style={styles.description}>Carregando...</Text>
    </View>
  );

  return (
    <ScrollView style={styles.container}>
      
      {competidores.map(competidor => {
        posicao+=1; 
        return (
        <View style={styles.containerPerfil} key={competidor.idPontoUsuario}>
          <View style={styles.fieldRow}>
            <Image
              key={competidor.idPontoUsuario+competidor.usuario.idUsuario} 
              style={styles.image} 
              source={{ uri: competidor.url + competidor.usuario.imagem }} />

            <View style={styles.fieldColumn}>
              <Text style={styles.label}>{competidor.usuario.nome}</Text>
              <Text style={styles.label}><Image source={level} style={styles.level}/> Pontos: {competidor.pontos}</Text>
            </View>

            <View style={styles.fieldColumn2}>
              <Text style={styles.labelPosicao}>{posicao}°</Text>
            </View>
          </View>
        </View>
        
        );
      })}
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFF',
  },

  description: {
    fontFamily: 'Nunito_600SemiBold',
    color: '#5c8599',
    lineHeight: 24,
    marginTop: 16,
  },

  // Perfil
  containerPerfil: {
    flex: 1,
    display: 'flex',
    flexDirection: 'row',
    marginTop: 8,
    marginRight: 8,
    marginLeft: 8,
    marginBottom: 8,

    // Linha Linha Horizontal
    borderBottomColor: '#F2F3F5',
    borderBottomWidth: 1,
  },

  fieldRow: {
    flex: 1,
    display: 'flex',
    flexDirection: 'row',
  },

  fieldColumn: {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    margin: 8,
  },

  fieldColumn2: {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    margin: 8,
    justifyContent: 'center',
    alignItems: 'flex-end'
  },

  image: {
    width: 65,
    height: 65,
    resizeMode: 'cover',

    borderRadius: 20,
    borderWidth: 1,
    borderColor: '#F2F3F5',
  },

  label: {
    color: '#8fa7b3',
    fontFamily: 'Nunito_600SemiBold',
    marginBottom: 8,
  },

  labelPosicao: {
    color: '#34CB79',
    fontFamily: 'Nunito_600SemiBold',
    marginBottom: 8,
    fontSize: 24,
  },

  level: {
    width: 12,
    height: 12,
  },
});