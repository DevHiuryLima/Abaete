
import React, { useState } from 'react';
import { Dimensions, ScrollView, StyleSheet, Text, TextInput, TouchableOpacity, View } from 'react-native';
import { useNavigation } from '@react-navigation/native';
import axios from 'axios';

import api from '../../services/api';

export default function Login() {
  const [email, setEmail] = useState('');
  const [senha, setSenha] = useState('');
  const navigation = useNavigation();

  async function handlelogin() {
    const data = new FormData();

    try {
      data.append('email', email);
      data.append('senha', senha);

      // Envia a requisição de maneira direta no axios.
      // const response = await axios({
      //   method: 'post',
      //   url: 'http://10.7.7.50/Projects/Abaete/web/public/api/usuarios/login',
      //   data: data,
      //   headers: {
      //     'Content-Type': 'multipart/form-data',
      //   },
      // })

      // Envia a requisição pelos pseudônimos e após a criação de uma instância do axios.
      const response = await api.post('usuarios/login', data);
      

      const id = await response.data.idUsuario;
      // console.log(response);
      if(response.status === 200){
        // AsyncStorage.setItem("TOKEN", response.access_token)

        navigation.navigate('Quiz', { id });
      }
      
    } catch (error) {
            
      console.log(error);
      console.log('\n');
      console.log(error.response);
      console.log('\n');
      console.log(error.response._response);

      if(error.response.status === 0){
        return alert('Desculpe, ocorreu um erro de conexão no login, tente novamente mais tarde.');
      } else {
        return alert(error.response.data.message);
      }

    }
  }

  function handleNavigateCreateAccount() {
    navigation.navigate('CriarConta');
  }

  return (
    <ScrollView style={styles.container}>
      <Text style={styles.title}>Faça Login</Text>
       
       <Text style={styles.label}>E-mail*</Text>
       <TextInput
          style={styles.input}
          value={email}
          onChangeText={setEmail}
       />
       
       <Text style={styles.label}>Senha*</Text>
       <TextInput
          style={styles.input}
          value={senha}
          onChangeText={setSenha}
          secureTextEntry={true}
       />

      <TouchableOpacity style={styles.loginButton} onPress={handlelogin}>
        <Text style={styles.loginButtonText}>Login</Text>
      </TouchableOpacity>

      <TouchableOpacity style={styles.createAccountButton} onPress={handleNavigateCreateAccount}>
        <Text style={styles.createAccountButtonText}>Criar conta</Text>
      </TouchableOpacity>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFFFFF',
    padding: 15,
  },

  title: {
    color: '#5C8599',
    fontSize: 24,
    fontFamily: 'Nunito_700Bold',
    marginBottom: 32,
    paddingBottom: 24,
    borderBottomWidth: 0.8,
    borderBottomColor: '#D3E2E5',
  },

  label: {
    color: '#8FA7B3',
    fontFamily: 'Nunito_600SemiBold',
    marginBottom: 8,
  },

  input: {
    backgroundColor: '#FFFFFF',
    borderWidth: 1.4,
    borderColor: '#D3E2E5',
    borderRadius: 20,
    height: 56,
    paddingVertical: 18,
    paddingHorizontal: 24,
    marginBottom: 16,
    textAlignVertical: 'top',
    color: '#5C8599',
  },

  loginButton: {
    backgroundColor: '#34CB79',
    borderRadius: 20,
    justifyContent: 'center',
    alignItems: 'center',
    height: 56,
    marginTop: 32,
  },

  loginButtonText: {
    fontFamily: 'Nunito_800ExtraBold',
    fontSize: 16,
    color: '#FFFFFF',
  },

  createAccountButton: {
    justifyContent: 'center',
    alignItems: 'center',
    height: 56,
    marginTop: 8,
  },

  createAccountButtonText: {
    justifyContent: 'center',
    alignItems: 'center',
    fontFamily: 'Nunito_800ExtraBold',
    fontSize: 16,
    color: '#8FA7B3',
  }
})