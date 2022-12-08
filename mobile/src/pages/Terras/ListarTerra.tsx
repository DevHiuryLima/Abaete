import React, { useEffect, useState } from 'react';
import { Image, View, ScrollView, Text, StyleSheet, Dimensions, TouchableOpacity, Linking } from 'react-native';
import MapView, { Marker, PROVIDER_GOOGLE } from 'react-native-maps';
import { useRoute } from '@react-navigation/native';
import { v4 as uuidv4 } from 'uuid';

import mapMarker from '../../images/MapaDeTerras/map-marker.png';
import api from '../../services/api';

interface ListarTerraRouteParams {
  id: number;
}

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
  referencia_das_fotos: string;
  created_at: string;
  updated_at: string;
  url: string;
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

export default function ListarTerra() {
  const route = useRoute();
  const [terra, setTerra] = useState<Terra>();

  const params = route.params as ListarTerraRouteParams;

  useEffect(() => {
    api.get(`terras/${params.id}`).then(response => {
      // console.log(response.data);
      setTerra(response.data);
    }).catch((error) => {
      console.log(error);
    })
  }, [params.id]);

  function handleOpenGoogleMapsRoutes(){
    Linking.openURL(`https://www.google.com/maps/dir/?api=1&destination=${terra?.latitude},${terra?.longitude}`)
  };

  if(!terra) return (
    <View style={styles.container}>
      <Text style={styles.description}>Carregando...</Text>
    </View>
  );

  // console.log(terra?.imagens_terra.map(i => i.idImagem.));

  return (
    <ScrollView style={styles.container}>
      <View style={styles.imagesContainer}>
        <ScrollView horizontal pagingEnabled>
          {terra?.imagens_terra.map(imagem => {            
            return (
              <Image
                key={imagem.idImagem.toString()}
                style={styles.image}
                source={{ uri: terra?.url + imagem.url }} />
            );
          })}
        </ScrollView>
      </View>

      <View style={styles.fieldGroupReferencia}>
        <View style={styles.fieldReferencia} >
          <Text style={styles.contentDataReferencia}>{terra?.referencia_das_fotos}</Text>
        </View>
      </View>

      
      <View style={styles.fieldGroup}>
        <View style={styles.field}>
          <Text style={styles.contentTitle}>Nome</Text>
          <View style={styles.lineHorizontal} />
          <Text style={styles.contentData}>{terra?.nome}</Text>
        </View>

        <View style={styles.field}>
          <Text style={styles.contentTitle}>População</Text>
          <View style={styles.lineHorizontal} />
          <Text style={styles.contentData}>{terra?.populacao}</Text>
        </View>
      </View>

      <View style={styles.fieldGroup}>
        <View style={styles.field}>
          <Text style={styles.contentTitle}>Povos</Text>
          <View style={styles.lineHorizontal} />
          <Text style={styles.contentData}>{terra?.povos}</Text>
        </View>

        <View style={styles.field}>
          <Text style={styles.contentTitle}>Língua</Text>
          <View style={styles.lineHorizontal} />
          <Text style={styles.contentData}>{terra?.lingua}</Text>
        </View>
      </View>

      <View style={styles.fieldGroup}>
        <View style={styles.field}>
          <Text style={styles.contentTitle}>Modalidade</Text>
          <View style={styles.lineHorizontal} />
          <Text style={styles.contentData}>{terra?.modalidade}</Text>
        </View>
      </View>
      
      <View style={styles.fieldGroup}>
        <View style={styles.field}>
          <Text style={styles.contentTitle}>Estado</Text>
          <View style={styles.lineHorizontal} />
          <Text style={styles.contentData}>{terra?.estado}</Text>
        </View>
      </View>

      <View style={styles.fieldGroup}>        
        <View style={styles.field}>
          <Text style={styles.contentTitle}>Cidade</Text>
          <View style={styles.lineHorizontal} />
          <Text style={styles.contentData}>
            {terra?.cidades.map(cidade => {
              return (
                <Text>- {cidade.cidade}{'\n'}</Text>
              );
            })}
          </Text>
        </View>
      </View>
        
      <View style={styles.about}>
        <Text style={styles.contentTitle}>Sobre</Text>
        <View style={styles.lineHorizontal} />
        <Text style={styles.contentData}>{terra?.sobre}</Text>
      </View>

      <View style={styles.mapContainer}>
        <MapView
          provider={PROVIDER_GOOGLE}
          style={styles.map}
          initialRegion={{
            latitude:Number(terra?.latitude),
            longitude:Number(terra?.longitude),
            latitudeDelta: 4.800,
            longitudeDelta: 4.800,
          }}
        >
          <Marker icon={mapMarker} calloutAnchor={{ x: 2.4, y: 0.8, }} coordinate={{ latitude:Number(terra?.latitude),longitude:Number(terra?.longitude), }} />
        </MapView>

        <TouchableOpacity onPress={handleOpenGoogleMapsRoutes} style={styles.routesContainer}>
          <Text style={styles.routesText}>Ver rotas no Google Maps</Text>
        </TouchableOpacity>
      </View>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFF',
  },

  imagesContainer: {
    height: 240,
  },

  image: {
    width: Dimensions.get('window').width,
    height: 240,
    resizeMode: 'contain',
  },

  fieldGroup: {
    flex: 1,
    display: 'flex',
    flexDirection: 'row',
    margin: 16,
  },

  field: {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    margin: 6,
  },

  fieldGroupReferencia: {
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    margin: 16,
    marginBottom: 40,
  },
  
  fieldReferencia: {
    fontSize: 12,
    flex: 1,
    display: 'flex',
    flexDirection: 'column',
    margin: 6,
  },

  contentTitle: {
    flex: 1,
    fontFamily: 'Nunito_700Bold',
    fontSize: 24,
    color: '#4D6F80',
  },

  lineHorizontal: {
    borderBottomColor: '#D3E2E6',
    borderBottomWidth: 1,
    height: 1,
  },

  contentData: {
    fontFamily: 'Nunito_700Bold',
    fontSize: 18,
    textAlign: 'justify', 
    color: '#5C8599',
  },

  contentDataReferencia: {
    fontFamily: 'Nunito_700Bold',
    fontSize: 12,
    textAlign: 'justify', 
    color: '#5C8599',
  },

  about: {
    margin: 16,
  },

  mapContainer: {
    borderRadius: 20,
    overflow: 'hidden',
    borderWidth: 1.2,
    borderColor: '#B3DAE2',
    margin: 16,
    marginTop: 40,
    backgroundColor: '#E6F7FB',
    width: 328,
    height: 300,
  },

  map: {
    flex: 1,
  },

  mapStyle: {
    width: '100%',
    height: 150,
  },

  routesContainer: {
    padding: 16,
    alignItems: 'center',
    justifyContent: 'center',
  },

  routesText: {
    fontFamily: 'Nunito_700Bold',
    color: '#0089a5'
  },

  description: {
    fontFamily: 'Nunito_600SemiBold',
    color: '#5c8599',
    lineHeight: 24,
    marginTop: 16,
  },
});