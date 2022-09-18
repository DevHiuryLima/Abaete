import React, { useState } from 'react';
import { Image, ScrollView, View, StyleSheet, Switch, Text, TextInput, TouchableOpacity, Dimensions } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { RectButton } from 'react-native-gesture-handler';
import { useNavigation, useRoute } from '@react-navigation/native';

import * as ImagePicker from 'expo-image-picker';
import api from '../../services/api';
import homeBackground from '../../images/Home/home-background.png';
import levelUpQuizIcon from '../../images/Quiz/levelUpQuizIcon.png';
import level from '../../images/Quiz/level.png';

export default function Quiz() {
  const navigation = useNavigation();

  function logout(){
    // navigation.reset({
    //   index: 0,
    //   routes: [{name: 'Login'}]
    // })

    // AsyncStorage.removeItem("TOKEN")

    navigation.navigate('Login');
  }

  return (
    <ScrollView style={styles.container}>

      <View style={styles.containerPerfil}>
        <View style={styles.fieldRow}>
          <Image
            key={'ksjf13mafjalsas23as11k2jdg2131913c0la'} 
            style={styles.image} 
            source={homeBackground} />

          <View style={styles.fieldColumn}>
            <Text style={styles.label}>Hiury Lima</Text>
            <Text style={styles.label}><Image source={level} style={styles.level}/> Pontos: 80</Text>
          </View>
        </View>
      </View>

      {/* <View style={styles.lineHorizontal} /> */}

      <View style={styles.Countdown}>
        <View style={styles.CountdownContainerTitle}>
          <Text style={styles.title}>Tempo restante</Text>
        </View>

        <View style={styles.countdownContainer}>
          <View style={styles.CountdownCardsGroup}>
            <Text style={styles.CountdownCard}>2</Text>
          </View>

          <View style={styles.lineVertical}/>

          <View style={styles.CountdownCardsGroup}>
            <Text style={styles.CountdownCard}>4</Text>
          </View>

          <Text style={styles.CountdownSeparator}>:</Text>

          <View style={styles.CountdownCardsGroup}>
            <Text style={styles.CountdownCard}>0</Text>
          </View>

          <View style={styles.lineVertical}/>

          <View style={styles.CountdownCardsGroup}>
            <Text style={styles.CountdownCard}>0</Text>
          </View>



          {/* <View>
            <Text>Horas</Text>
          </View> */}

          {/* Daqui para baixo tudo é funcional  */}
          {/* Horas */}
          {/* <View style={styles.CountdownCardsGroup}>
            <Text style={styles.CountdownCard}>2</Text>
            <View style={styles.lineVertical}/>
            <Text style={styles.CountdownCard}>4</Text>
          </View>
          <View>
            <Text>Horas</Text>
          </View> */}
          
          {/* <Text style={styles.CountdownSeparator}>:</Text> */}

          {/* Minutos */}
          {/* <View style={styles.CountdownCardsGroup}>
            <Text style={styles.CountdownCard}>0</Text>
            <View style={styles.lineVertical}/>
            <Text style={styles.CountdownCard}>0</Text>
          </View> */}

          {/* <Text style={styles.CountdownSeparator}>:</Text> */}

          {/* Segundos */}
          {/* <View style={styles.CountdownCardsGroup}>
            <Text style={styles.CountdownCard}>0</Text>
            <View style={styles.lineVertical}/>
            <Text style={styles.CountdownCard}>0</Text>
          </View> */}
        </View>

        <View style={styles.containerInformacoes}>
          <View>
            <Text style={styles.containerInformacoesText}>Horas</Text>
          </View>
          <View>
            <Text style={styles.containerInformacoesText}>Minutos</Text>
          </View>
        </View>

      </View>


      {/* ChallengeBox */}
      <View style={styles.challengeBox}>
        <View style={styles.challengeNotActive}>
          <View style={styles.notActiveTitle}>
            <Text>
              Aguarde um ciclo para receber uma questão
            </Text>
          </View>

          <View style={styles.levelUpQuizIcon}>
            <Image source={levelUpQuizIcon}/>
          </View>

          <View style={styles.notActiveSubTitle}>
            <Text>
              Ganhe pontos respondendo as questões corretamente.
            </Text>
          </View>
        </View>

      </View>
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
    marginBottom: 16,
  },

  fieldRow: {
    flex: 1,
    display: 'flex',
    flexDirection: 'row',
    // marginBottom: 24,
    // marginRight: 24,
    // margin: 6,
  },

  fieldColumn: {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    // marginBottom: 24,
    // marginRight: 24,
    margin: 8,
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

  level: {
    width: 12,
    height: 12,
  },





  // CountDown
  Countdown: {
    marginTop: 16,
    marginBottom: 16,
  },

  CountdownContainerTitle: {
    flex: 1,
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    // width: Dimensions.get('window').width,
  },

  title: {
    fontFamily: 'Nunito_600SemiBold',
    fontSize: 28,
    color: '#000',


    // Linha Linha Horizontal
    borderBottomColor: '#F2F3F5',
    borderBottomWidth: 1,
  },

  // CountDown -> Linha Horizontal
  lineHorizontal: {
    borderBottomColor: '#F2F3F5',
    borderBottomWidth: 1,
    height: 1,
  },

  countdownContainer: {
    // Feito com base no projeto do @sunderhus.
    flex: 1,
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center', 
    fontFamily: 'Nunito_600SemiBold', //'Rajdhani',
    margin: 8,
  },

  CountdownCardsGroup: {
    // Feito com base no projeto do @sunderhus.
    flex: 1,
    flexDirection: 'column', //Antes era 'row'.
    textAlign: 'center', // Isso não tinha
    alignItems: 'center', // Isso não tinha
    // justifyContent: 'space-evenly', // Comenteei esse
    backgroundColor: '#F2F3F5',
    boxShadow: '#000',
    borderRadius: 5,
  },

  CountdownCard: {
    // Feito com base no projeto do @sunderhus.
    fontSize: 82,
    color: '#000',
  },

  lineVertical: {
    // Feito com base no projeto do @sunderhus.
    flex: 1,
    backgroundColor: '#FFF', // era #f0f1f3
    maxWidth: 2,
  },

  CountdownSeparator: {
    // Feito com base no projeto do @sunderhus.
    fontSize: 82,
    margin: 4,
    color: '#000',
  },

  containerInformacoes: {
    flex: 1,
    flexDirection: 'row',
    width: Dimensions.get('window').width,
    alignItems: 'center',
    justifyContent: 'space-around',
    textAlign: 'center',
  },

  containerInformacoesText: {
    // Linha Linha Horizontal
    borderBottomColor: '#F2F3F5',
    borderBottomWidth: 1,
  },




  // ChallengeBox
  challengeBox: {
    flex: 1,
    marginTop: 16,
    marginRight: 8,
    marginBottom: 16,
    marginLeft: 8,
    // backgroundColor: '#F2F3F5',
    borderWidth: 1,
    borderRadius: 5,
    borderColor: '#F2F3F5',
    paddingLeft: 10,
    paddingRight: 10,
    flexDirection: 'row',
  },

  challengeActive: {

  },

  challengeActiveHeader: {

  },

  challengeActiveMain: {

  },

  challengeDescription: {

  },

  challengeActiveFooter: {

  },

  challengeButton: {

  },

  challengeNotActive: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },

  notActiveTitle: {
    textAlign: 'center',
    fontFamily: 'Nunito_600SemiBold',
    fontSize: 24,
    marginBottom: 16,
    // flexDirection: 'row',
    color: '#000',
  },

  levelUpQuizIcon: {
    // position: 'absolute',
    width: 120,
    height: 120,
    justifyContent: 'center',
    alignItems: 'center',
  },

  notActiveSubTitle: {
    // flexDirection: 'row',
    alignItems: 'center',
    textAlign: 'center',
    // maxWidth: 70,
    marginTop: 16,
    // color: '#000',
  },
});