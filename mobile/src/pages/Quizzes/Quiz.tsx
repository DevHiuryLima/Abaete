import React, { useState } from 'react';
import { Image, ScrollView, View, StyleSheet, Switch, Text, TextInput, TouchableOpacity, Dimensions } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { RectButton } from 'react-native-gesture-handler';
import { useNavigation, useRoute } from '@react-navigation/native';

import * as ImagePicker from 'expo-image-picker';
import api from '../../services/api';
import homeBackground from '../../images/Home/home-background.png';

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
            <Text style={styles.label}>Pontos: 80</Text>
          </View>
        </View>
      </View>

      {/* <View style={styles.lineHorizontal} /> */}

      <View style={styles.Countdown}>
        <View style={styles.CountdownContainerTitle}>
          <Text style={styles.title}>Tempo restante</Text>
        </View>

        <View style={styles.countdownContainer}>
          {/* Horas */}
          <View style={styles.CountdownCardsGroup}>
            <Text style={styles.CountdownCard}>2</Text>
            <View style={styles.lineVertical}/>
            <Text style={styles.CountdownCard}>4</Text>
          </View>
          
          <Text style={styles.CountdownSeparator}>:</Text>

          {/* Minutos */}
          <View style={styles.CountdownCardsGroup}>
            <Text style={styles.CountdownCard}>0</Text>
            <View style={styles.lineVertical}/>
            <Text style={styles.CountdownCard}>0</Text>
          </View>

          <Text style={styles.CountdownSeparator}>:</Text>

          {/* Segundos */}
          <View style={styles.CountdownCardsGroup}>
            <Text style={styles.CountdownCard}>0</Text>
            <View style={styles.lineVertical}/>
            <Text style={styles.CountdownCard}>0</Text>
          </View>
        </View>
      </View>


      {/* ChallengeBox */}
      <View style={styles.challengeBox}>
        {/* <View style={styles.challengeActive}>
          <View style={styles.challengeActiveHeader}><Text>Ganhe 10 pontos</Text></View>

          <View style={styles.challengeActiveMain}>
            
            <Text>
              Falta um icone
            </Text>
            <Text>
              Novo Desafio
            </Text>
            <View style={styles.challengeDescription}>
              <Text>Lorem ipsum dolor sit amet consectetur adipisicing elit.</Text>
            </View>
          </View>


          <View style={styles.challengeActiveFooter}>
            <TouchableOpacity style={styles.challengeButton} onPress={}>
              <Feather name='arrow-right' color='rgba(0, 0, 0, 0.6)' />
            </TouchableOpacity>
          </View>
        </View> */}

        <View style={styles.challengeNotActive}>
          <Text style={styles.notActiveTitle}>
            Aguarde um ciclo para receber uma questão
          </Text>

          <Feather name='arrow-right' color='rgba(0, 0, 0, 0.6)' />

          <Text style={styles.notActiveSubTitle}>
            Ganhe pontos respondendo as questões corretamente.
          </Text>
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
    borderRadius: 20,
    // backgroundColor: '#00FF00',
    backgroundColor: '#F2F3F5',
  },

  label: {
    color: '#8fa7b3',
    fontFamily: 'Nunito_600SemiBold',
    marginBottom: 8,
  },

  
  // Linha Horizontal
  lineHorizontal: {
    borderBottomColor: '#D3E2E6',
    borderBottomWidth: 1,
    height: 1,
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
  },

  title: {
    fontFamily: 'Nunito_600SemiBold',
    fontSize: 28,
    color: '#000',
  },

  countdownContainer: {
    // Feito com base no projeto do @sunderhus.
    flex: 1,
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center', 
    fontFamily: 'Nunito_600SemiBold', //'Rajdhani',
    margin: 8,

    // Feito com base no meu projeto em reacJS.
    // display: 'flex',
    // alignItems: 'center',
    // fontFamily: 'Nunito_600SemiBold', //'Rajdhani',
    // fontWeight: 600,
    // color: '#2E384D',
  },

  CountdownCardsGroup: {
    // Feito com base no projeto do @sunderhus.
    flex: 1,
    flexDirection: 'row',
    justifyContent: 'space-evenly',
    backgroundColor: '#F2F3F5',
    boxShadow: '#000',
    borderRadius: 5,

    // Feito com base no meu projeto em reacJS.
    // flex: 1,
    // display: 'flex',
    // alignItems: 'center',
    // justifyContent: 'space-evenly',

    // background: '#FFF',
    // boxShadow: '0 0 60 rgba(0, 0, 0, 0.05)',
    // borderRadius: 5,
    // fontSize: 8.5,
    // textAlign: 'center',
  },

  CountdownCard: {
    // Feito com base no projeto do @sunderhus.
    fontSize: 82,
    color: '#000',

    // Feito com base no meu projeto em reacJS.
    // flex: 1,
    // borderRight: '1 solid #f0f1f3',
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


  // ChallengeBox
  challengeBox: {
    flex: 1,
    marginTop: 16,
    marginRight: 8,
    marginBottom: 16,
    marginLeft: 8,
    // backgroundColor: '#F2F3F5',
    // borderWidth: 2,
    // borderStyle: 'solid',
    // borderColor: '#F2F3F5',
    borderRadius: 5,
    boxShadow: '#000',
    padding: 10,
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
    flexDirection: 'row',
    color: '#000',
  },

  notActiveSubTitle: {
    flexDirection: 'row',
    alignItems: 'center',
    textAlign: 'center',
    // maxWidth: 100,
    marginTop: 16,
    color: '#000',
  },
});