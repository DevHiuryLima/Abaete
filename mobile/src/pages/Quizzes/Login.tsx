
import React, { useState } from 'react';
import { Image, ScrollView, View, StyleSheet, Switch, Text, TextInput, TouchableOpacity, Dimensions } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { RectButton } from 'react-native-gesture-handler';
import { useNavigation, useRoute } from '@react-navigation/native';

import api from '../../services/api';

export default function Login() {
  const [email, setEmail] = useState('');
  const [senha, setSenha] = useState('');
  const navigation = useNavigation();

  async function handlelogin() {
    alert("Usuario logado");
  }

  function handleNavigateCreateAccount() {
    navigation.navigate('CriarConta');
  }

  return (
    <ScrollView style={styles.container} contentContainerStyle={{ padding: 24 }}>
      <Text style={styles.title}>Faça Login</Text>
       
       <Text style={styles.label}>Email*</Text>
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
  },

  title: {
    color: '#5c8599',
    fontSize: 24,
    fontFamily: 'Nunito_700Bold',
    marginBottom: 32,
    paddingBottom: 24,
    borderBottomWidth: 0.8,
    borderBottomColor: '#D3E2E6'
  },

  label: {
    color: '#8fa7b3',
    fontFamily: 'Nunito_600SemiBold',
    marginBottom: 8,
  },

  input: {
    backgroundColor: '#fff',
    borderWidth: 1.4,
    borderColor: '#d3e2e6',
    borderRadius: 20,
    height: 56,
    paddingVertical: 18,
    paddingHorizontal: 24,
    marginBottom: 16,
    textAlignVertical: 'top',
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
    color: '#FFF',
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
    color: '#8fa7b3',
  }

  
})