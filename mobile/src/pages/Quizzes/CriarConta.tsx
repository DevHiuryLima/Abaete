import React, { useState } from 'react';
import { Image, ScrollView, View, StyleSheet, Text, TextInput, TouchableOpacity } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { useNavigation } from '@react-navigation/native';

import * as ImagePicker from 'expo-image-picker';
import api from '../../services/api';

export default function CriarUsuario() {
  const [nome, setNome] = useState('');
  const [email, setEmail] = useState('');
  const [confirmarEmail, setConfirmarEmail] = useState('');
  const [senha, setSenha] = useState('');
  const [confirmarSenha, setConfirmarSenha] = useState('');
  const [image, setImage] = useState('');
  const navigation = useNavigation();

  async function handleCreateUser() {

    if(!(email == confirmarEmail)){
      return alert('Os campos email e confirmar email devem conter valores iguais.')
    }

    if(senha.length < 6) {
      console.log('O campo senha precisa ter no mínimo 6 caracteres.');
    }

    if(confirmarSenha.length < 6) {
      console.log('O campo confirmar senha precisa ter no mínimo 6 caracteres.');
    }

    if(!(senha == confirmarSenha)){
      return alert('Os campos senha e confirmar senha devem conter valores iguais.')
    }


    const data = new FormData();
    
    try {
      data.append('nome', nome);
      data.append('imagem', {
        type: 'image/jpg',
        uri: image,
        name: 'perfil-' + nome,
      } as any);
      data.append('email', email);
      data.append('confirmarEmail', confirmarEmail);
      data.append('senha', senha);
      data.append('confirmarSenha', confirmarSenha);

      // Envia a requisição pelos pseudônimos e após a criação de uma instância do axios.
      const response = await api.post('usuarios', data);

      const id = await response.data.idUsuario;
      // console.log(response);   
      if(response.status === 200){

        // AsyncStorage.setItem("TOKEN", response.data.access_token)
        navigation.navigate('Quiz', { id });
      }
    } catch (error) {

      // console.log(error);
      // console.log('\n');
      // console.log(error.response);
      // console.log('\n');
      // console.log(error.response._response);

      if(error.response.status === 0){
        return alert('Desculpe, ocorreu um erro de conexão no login, tente novamente mais tarde.');

      } else if(error.response.status === 422){
        // console.log(error.response.data);

        // var errors
        Object.keys(error.response.data).forEach(function(item){

          return alert(error.response.data[item]);

          // errors = error.response.data[item] + '\n';
          
         });
      } else {
        return alert(error.response.data.message);
      }
      
    }
  }


  function handleLogin() {
    navigation.navigate('Login');
  }

  async function handleSelectImages() {
    const { status } = await ImagePicker.requestMediaLibraryPermissionsAsync();

    if(status !== 'granted') return alert('Precisamos de acesso à suas fotos!');

    const result = await ImagePicker.launchImageLibraryAsync({
      mediaTypes: ImagePicker.MediaTypeOptions.Images,
      allowsEditing: true,
      quality: 1,
    });

    // if(result.cancelled) return;

    // const { uri: image } = result;
    // setImages([...images, image]);

    // console.log(result);

    if (!result.cancelled) {

      setImage(result.uri);
    }
  }

  return (
    <ScrollView style={styles.container} contentContainerStyle={{ padding: 24 }}>
      <Text style={styles.title}>Insira seus Dados</Text>
        
      <Text style={styles.label}>Foto*</Text>

      { image ? (
        <View style={styles.containerUpload}>
          <TouchableOpacity  style={styles.uploadButton} onPress={handleSelectImages}>
            <Image key={image} source={{uri: image}} style={styles.uploadedImage} />
          </TouchableOpacity>
        </View>
      ) : (
        <View style={styles.containerUpload}>
          <TouchableOpacity style={styles.uploadButton} onPress={handleSelectImages}>
            <Feather name="plus" size={24} color="#15B6D6" />
          </TouchableOpacity>
        </View>
      )}

      <Text style={styles.label}>Nome*</Text>
      <TextInput
        style={styles.input}
        value={nome}
        onChangeText={setNome}
      />
       
      <Text style={styles.label}>E-mail*</Text>
      <TextInput
        style={styles.input}
        value={email}
        onChangeText={setEmail}
      />

      <Text style={styles.label}>Confirmar e-mail*</Text>
      <TextInput
        style={styles.input}
        value={confirmarEmail}
        onChangeText={setConfirmarEmail}
      />
       
      <Text style={styles.label}>Senha*</Text>
      <TextInput
        style={styles.input}
        value={senha}
        onChangeText={setSenha}
        secureTextEntry={true}          
      />

      <Text style={styles.label}>Confirmar senha*</Text>
      <TextInput
        style={styles.input}
        value={confirmarSenha}
        onChangeText={setConfirmarSenha}
        secureTextEntry={true}
      />

      <TouchableOpacity style={styles.cadastrarButton} onPress={handleCreateUser}>
        <Text style={styles.cadastrarButtonText}>Cadastrar</Text>
      </TouchableOpacity>

      <TouchableOpacity style={styles.loginButton} onPress={handleLogin}>
        <Text style={styles.loginButtonText}>Fazer login</Text>
      </TouchableOpacity>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFFFFF',
  },

  title: {
    color: '#5C8599',
    fontSize: 24,
    fontFamily: 'Nunito_700Bold',
    marginBottom: 32,
    paddingBottom: 24,
    borderBottomWidth: 0.8,
    borderBottomColor: '#D3E2E6'
  },

  label: {
    color: '#8FA7B3',
    fontFamily: 'Nunito_600SemiBold',
    marginBottom: 8,
  },

  containerUpload: {
    flexDirection: 'column',
    justifyContent: 'center',
    alignItems: 'center',
  },

  uploadButton: {
    backgroundColor: '#F5F8FA',
    borderStyle: 'dashed',
    borderColor: '#96D2F0',
    borderWidth: 1.4,
    borderRadius: 20,
    width: 250,
    height: 250,
    justifyContent: 'center',
    alignItems: 'center',
    marginBottom: 32,
    padding: 5,
  },

  uploadedImage: {
    width: 250,
    height: 250,
    borderRadius: 20,
    resizeMode: 'cover',
    justifyContent: 'center',
    alignItems: 'center',
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
  },

  cadastrarButton: {
    backgroundColor: '#34CB79',
    borderRadius: 20,
    justifyContent: 'center',
    alignItems: 'center',
    height: 56,
    marginTop: 32,
  },

  cadastrarButtonText: {
    fontFamily: 'Nunito_800ExtraBold',
    fontSize: 16,
    color: '#FFFFFF',
  },

  loginButton: {
    justifyContent: 'center',
    alignItems: 'center',
    height: 56,
    marginTop: 8,
  },

  loginButtonText: {
    justifyContent: 'center',
    alignItems: 'center',
    fontFamily: 'Nunito_800ExtraBold',
    fontSize: 16,
    color: '#8FA7B3',
  }
})