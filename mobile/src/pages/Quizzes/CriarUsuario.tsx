
import React, { useState } from 'react';
import { Image, ScrollView, View, StyleSheet, Switch, Text, TextInput, TouchableOpacity, Dimensions } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { RectButton } from 'react-native-gesture-handler';
import { useNavigation, useRoute } from '@react-navigation/native';

import * as ImagePicker from 'expo-image-picker';
import api from '../../services/api';

export default function CriarUsuario() {
  const [name, setName] = useState('');
  const [image, setImage] = useState('')

  async function handleCreateUser() {
    const data = new FormData();

    // data.append('image', {
    //   uri: image.uri,
    //   type: image.type,
    // });

    //Salva o data no asyncStorage

    alert("Usuario criado");
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

    console.log(result);

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
          value={name}
          onChangeText={setName}
          placeholder="Nome"
       />

      <TouchableOpacity style={styles.nextButton} onPress={handleCreateUser}>
        <Text style={styles.nextButtonText}>Salvar</Text>
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

  containerUpload: {
    // flex: 1,
    flexDirection: 'column',
    justifyContent: 'center',
    alignItems: 'center',
  },

  uploadButton: {
    // flex: 1,
    backgroundColor: 'rgba(255, 255, 255, 0.5)',
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
    // flex: 1,
    width: 250,
    height: 250,
    borderRadius: 20,
    resizeMode: 'cover',
    justifyContent: 'center',
    alignItems: 'center',
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

  nextButton: {
    backgroundColor: '#34CB79',
    borderRadius: 20,
    justifyContent: 'center',
    alignItems: 'center',
    height: 56,
    marginTop: 32,
  },

  nextButtonText: {
    fontFamily: 'Nunito_800ExtraBold',
    fontSize: 16,
    color: '#FFF',
  }
})