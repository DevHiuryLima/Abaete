import React from 'react';
import { StatusBar } from 'expo-status-bar';
import { View, ImageBackground, Text, Image, StyleSheet, TouchableOpacity, KeyboardAvoidingView, Dimensions, Platform} from "react-native";
import { Feather } from '@expo/vector-icons';
import { LinearGradient } from 'expo-linear-gradient';
import { useNavigation } from '@react-navigation/native';

import logo from '../../images/Home/logo.png';
import homeBackground from '../../images/Home/home-background.png';

export default function Home() {
  const navigation = useNavigation();

  function handleNavigateToMapaDeTerras() {
    navigation.navigate('MapaDeTerras');
  }

  return (
    <KeyboardAvoidingView style={{ flex: 1 }} behavior={Platform.OS === 'ios'? 'padding' : undefined}>
        <LinearGradient colors={['#34CB79', '#2FB86E']} style={{ flex: 1,  width: Dimensions.get('window').width, height: Dimensions.get('window').height, }}>

        
          <View style={styles.main}>
            <StatusBar style='dark' backgroundColor='transparent' translucent/>
            <Image source={logo}/>

            <View>
              <Text style={styles.title}>Descubra mais sobre os nativos brasileiros</Text>
              <Text style={styles.description}>Aprenda sobre quem são, onde vivem e muito mais sobre sua cultura e história.</Text>
            </View>
          </View>

          <View style={styles.footer}>
            <ImageBackground source={homeBackground} style={styles.container} imageStyle={{ width: 156, height: 260}} />
            
            <TouchableOpacity style={styles.button} onPress={handleNavigateToMapaDeTerras}>
              <View style={styles.buttonIcon}>
                <Text>
                  <Feather name="arrow-right" color='#00000099' />
                </Text>
              </View>
              <Text style={styles.buttonText}>
                Entrar
              </Text>
            </TouchableOpacity>
          </View>
        
      </LinearGradient>
    </KeyboardAvoidingView>
  );
}

const styles = StyleSheet.create({
  main: {
    flex: 1,
    padding: 20, // 32
    marginTop: 16,
    justifyContent: 'center',
  },

  title: {
    color: '#FFFFFF',
    fontSize: 32,
    fontFamily: 'Nunito_700Bold',
    maxWidth: 260,
    // marginTop: 16,
  },

  description: {
    color: '#FFFFFF',
    fontSize: 16,
    marginTop: 16,
    fontFamily: 'Nunito_600SemiBold',
    maxWidth: 260,
    lineHeight: 24,
  },

  footer: {
    flex: 1,
    margin: 8,
    // marginTop: 0,
    // marginBottom: 0,
  },

  container: {
    flex: 1,
  },

  button: {
    // height: 40,
    // width: 60,
    backgroundColor: '#FFD666',
    flexDirection: 'row',
    borderRadius: 10,
    overflow: 'hidden',
    alignItems: 'center',
    margin: 8,
  },

  buttonIcon: {
    height: 60,
    width: 60,
    backgroundColor: 'rgba(0, 0, 0, 0.1)',
    justifyContent: 'center',
    alignItems: 'center',
  },

  buttonText: {
    flex: 1,
    justifyContent: 'center',
    textAlign: 'center',
    color: '#00000099',
    fontFamily: 'Nunito_600SemiBold',
    fontSize: 16,
  }
});