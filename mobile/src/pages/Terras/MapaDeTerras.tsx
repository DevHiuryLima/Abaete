import React, { useEffect, useState} from 'react';
import { StyleSheet, Text, View, Dimensions, TouchableOpacity } from 'react-native';
import MapView, { Marker, Callout, PROVIDER_GOOGLE } from 'react-native-maps';
import { Feather } from '@expo/vector-icons';
import { useNavigation } from '@react-navigation/native';

import mapMarker from '../../images/MapaDeTerras/map-marker.png';
import api from '../../services/api';

interface Terra {
  idTerra: number;
  nome: string;
  populacao: string;
  povos: string;
  lingua: string;
  modalidade: string;
  sobre: string;
  latitude: number;
  longitude: number;
  estado: string;
  created_at: string;
  updated_at: string;
  cidades: Array<{
    idCidadeTerra: number;
    terra: number;
    cidade: string;
  }>;
  imagens_terra: Array<{
    idImagem: number;
    url: string;
  }>;
}

export default function MapaDeTerras() {
  const [terras, setTerra] = useState<Terra[]>([]);
  const navigation = useNavigation();

  useEffect(() => {
    api.get('terras').then(response => {
      // console.log(response.data);
      setTerra(response.data);
    }).catch((error) => {
      console.log(error);
    })
  }, []);

  function handleNavigateToListarTerra(id: number) {
    navigation.navigate('ListarTerra', { id });
  }

  function handleNavigateQuiz() {
    // Verifco se o usuario está logado  antes.   
    navigation.navigate('Login');
  }

  return (
    <View style={styles.container}>
      <MapView
        provider={PROVIDER_GOOGLE}
        style={styles.map}
        initialRegion={{
          latitude:-16.6958288,
          longitude:-49.4443537,
          latitudeDelta: 4.800,
          longitudeDelta: 4.800,
        }}
      >
        {terras.map(terra => {
          return (
            <Marker 
              key={terra.idTerra}
              icon={mapMarker}
              calloutAnchor={{
                x: 2.4,
                y: 0.8,
              }}
              coordinate={{
                latitude: Number(terra.latitude),
                longitude: Number(terra.longitude),
              }}
            >
              <Callout tooltip onPress={() => handleNavigateToListarTerra(terra.idTerra)}>
                <View style={styles.calloutContainer}>
                  <Text style={styles.calloutText}>{terra.nome}</Text>
                </View>
              </Callout>
            </Marker>
          );
        })}
      </MapView>

      <View style={styles.footer}>
          <Text style={styles.footerText}>Teste seu conhecimento</Text>

          <TouchableOpacity style={styles.redirectQuizButton} onPress={handleNavigateQuiz}>
            <Feather name='arrow-right' color='rgba(0, 0, 0, 0.6)' />
          </TouchableOpacity>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    // alignItems: 'center',
    justifyContent: 'center',
    // width: Dimensions.get('window').width,
    // height: Dimensions.get('window').height,
  },

  map: {
    flex: 1,
    width: Dimensions.get('window').width,
    height: Dimensions.get('window').height,
  },

  calloutContainer: {
    width: 160,
    height: 46,
    paddingHorizontal: 16,
    backgroundColor: 'rgba(255, 255, 255, 0.8)',
    borderRadius: 16,
    justifyContent: 'center',
  },

  calloutText: {
    color: '#2FB86E',
    fontSize: 14,
    fontFamily: 'Nunito_700Bold',
  },

  footer: {
    position: 'absolute',
    left: 24,
    right: 24,
    bottom: 32,

    backgroundColor: '#FFF',
    borderRadius: 20,
    height: 56,
    paddingLeft: 24,

    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',

    elevation: 3,
  },

  footerText: {
    fontFamily: 'Nunito_700Bold',
    color: '#5C8599',
  },

  redirectQuizButton: {
    width: 56,
    height: 56,
    backgroundColor: '#34CB79',
    // backgroundColor: '#FFD666',
    borderRadius: 20,

    justifyContent: 'center',
    alignItems: 'center',
  },
});