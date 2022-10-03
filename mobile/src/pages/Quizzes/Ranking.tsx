import React, { useEffect, useState } from 'react';
import { Image, ScrollView, View, StyleSheet, Switch, Text, TextInput, TouchableOpacity, Dimensions, TextInputState } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { RectButton } from 'react-native-gesture-handler';
import { useNavigation, useRoute } from '@react-navigation/native';
// import { CheckBox } from 'react-native-elements'

import * as ImagePicker from 'expo-image-picker';
import api from '../../services/api';
import homeBackground from '../../images/Quiz/perfil.jpg';
import levelUpQuizIcon from '../../images/Quiz/levelUpQuizIcon.png';
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
              source={homeBackground} />

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
    // marginBottom: 24,
    // marginRight: 24,
    // margin: 6,
    // justifyContent: 'space-evenly'
  },

  fieldColumn: {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    // marginBottom: 24,
    // marginRight: 24,
    margin: 8,
  },

  fieldColumn2: {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    // marginBottom: 24,
    // marginRight: 24,
    margin: 8,
    justifyContent: 'center',
    alignItems: 'flex-end'
    // alignContent: 'flex-end'
  },

  image: {
    width: 65,
    height: 65,
    resizeMode: 'cover',
    // backgroundColor: '#F2F3F5',

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
    // color: '#8fa7b3',
    // color: '#FFD666',
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