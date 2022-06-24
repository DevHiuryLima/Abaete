// import React from 'react';
// import { Image, View, ScrollView, Text, StyleSheet, Dimensions, TouchableOpacity } from 'react-native';
// import MapView, { Marker, PROVIDER_GOOGLE } from 'react-native-maps';
// import { Feather } from '@expo/vector-icons';
// import mapMarker from '../../images/MapaDeTerras/map-marker.png';

// export default function ListarTerra() {
//   return (
//     <ScrollView style={styles.container}>
//       <View style={styles.imagesContainer}>
//         <ScrollView horizontal pagingEnabled>
//           <Image style={styles.image} source={ {uri: 'https://assets.survivalinternational.org/pictures/12925/braz-ava-fw-21-original_article_column@2x.jpg'} } />
//           <Image style={styles.image} source={ {uri: 'https://assets.survivalinternational.org/pictures/12925/braz-ava-fw-21-original_article_column@2x.jpg'} } />
//           <Image style={styles.image} source={ {uri: 'https://assets.survivalinternational.org/pictures/12925/braz-ava-fw-21-original_article_column@2x.jpg'} } />
//           <Image style={styles.image} source={ {uri: 'https://assets.survivalinternational.org/pictures/12925/braz-ava-fw-21-original_article_column@2x.jpg'} } />
//           <Image style={styles.image} source={ {uri: 'https://assets.survivalinternational.org/pictures/12925/braz-ava-fw-21-original_article_column@2x.jpg'} } />
//           <Image style={styles.image} source={ {uri: 'https://assets.survivalinternational.org/pictures/12925/braz-ava-fw-21-original_article_column@2x.jpg'} } />
//           <Image style={styles.image} source={ {uri: 'https://assets.survivalinternational.org/pictures/12925/braz-ava-fw-21-original_article_column@2x.jpg'} } />
//         </ScrollView>
//       </View>

//       <View style={styles.detailsContainer}>
//         <Text style={styles.title}>Avá-canoeiro</Text>
//         <Text style={styles.description}>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto deserunt alias laborum dolore. Recusandae nisi vitae consectetur temporibus omnis saepe alias aut repudiandae vero. Nulla libero blanditiis eligendi fugit temporibus?</Text>
        
//         <View style={styles.mapContainer}>
//           <MapView
//             provider={PROVIDER_GOOGLE}
//             style={styles.map}
//             initialRegion={{
//               latitude:-16.6958288,
//               longitude:-49.4443537,
//               latitudeDelta: 4.800,
//               longitudeDelta: 4.800,
//             }}
//           >
//             <Marker icon={mapMarker} calloutAnchor={{ x: 2.4, y: 0.8, }} coordinate={{ latitude: -16.6954999, longitude: -49.444356, }} />
//           </MapView>

//           <TouchableOpacity onPress={() => {alert('Rota')}} style={styles.routesContainer}>
//             <Text style={styles.routesText}>Ver rotas no Google Maps</Text>
//           </TouchableOpacity>
//         </View>
        
//         <View style={styles.separator} />
        
//         <Text style={styles.title}>Instruções para visita</Text>
//         <Text style={styles.description}>Lorem ipsum dolor sit amet consectetur adipisicing elit.</Text>

//         <View style={styles.scheduleContainer}>
//           <View style={[styles.scheduleItem, styles.scheduleItemBlue]}>
//             <Feather name="clock" size={40} color="#2AB5D1" />
//             <Text style={[styles.scheduleText, styles.scheduleTextBlue]}>Segunda à Sexta às 12:00 até 16:00</Text>
//           </View>

//           <View style={[styles.scheduleItem, styles.scheduleItemGreen]}>
//             <Feather name="info" size={40} color="#39CC83" />
//             <Text style={[styles.scheduleText, styles.scheduleTextGreen]}>Atendemos fim de semana</Text>
//           </View>
//         </View>
//       </View>
//     </ScrollView>
//   );
// }

// const styles = StyleSheet.create({
//   container: {
//     flex: 1,
//   },

//   imagesContainer: {
//     height: 240,
//   },

//   image: {
//     width: Dimensions.get('window').width,
//     height: 240,
//     resizeMode: 'cover',
//   },
//   detailsContainer: {
//     padding: 24,
//   },

//   title: {
//     color: '#4D6F80',
//     fontSize: 30,
//     fontFamily: 'Nunito_700Bold',
//   },

//   description: {
//     fontFamily: 'Nunito_600SemiBold',
//     color: '#5c8599',
//     lineHeight: 24,
//     marginTop: 16,
//   },

//   mapContainer: {
//     borderRadius: 20,
//     overflow: 'hidden',
//     borderWidth: 1.2,
//     borderColor: '#B3DAE2',
//     marginTop: 40,
//     backgroundColor: '#E6F7FB',
//   },

//   map: {
//     // flex: 1,
//     // width: Dimensions.get('window').width,
//     // height: Dimensions.get('window').height,
//   },

//   mapStyle: {
//     width: '100%',
//     height: 150,
//   },

//   routesContainer: {
//     padding: 16,
//     alignItems: 'center',
//     justifyContent: 'center',
//   },

//   routesText: {
//     fontFamily: 'Nunito_700Bold',
//     color: '#0089a5'
//   },

//   separator: {
//     height: 0.8,
//     width: '100%',
//     backgroundColor: '#D3E2E6',
//     marginVertical: 40,
//   },

//   scheduleContainer: {
//     marginTop: 24,
//     flexDirection: 'row',
//     justifyContent: 'space-between'
//   },

//   scheduleItem: {
//     width: '48%',
//     padding: 20,
//   },

//   scheduleItemBlue: {
//     backgroundColor: '#E6F7FB',
//     borderWidth: 1,
//     borderColor: '#B3DAE2',
//     borderRadius: 20,
//   },

//   scheduleItemGreen: {
//     backgroundColor: '#EDFFF6',
//     borderWidth: 1,
//     borderColor: '#A1E9C5',
//     borderRadius: 20,
//   },

//   scheduleItemRed: {
//     backgroundColor: '#FEF6F9',
//     borderWidth: 1,
//     borderColor: '#FFBCD4',
//     borderRadius: 20,
//   },
  
//   scheduleText: {
//     fontFamily: 'Nunito_600SemiBold',
//     fontSize: 16,
//     lineHeight: 24,
//     marginTop: 20,
//   },

//   scheduleTextBlue: {
//     color: '#5C8599'
//   },

//   scheduleTextGreen: {
//     color: '#37C77F'
//   },

//   scheduleTextRed: {
//     color: '#FF669D'
//   },

//   contactButton: {
//     backgroundColor: '#3CDC8C',
//     borderRadius: 20,
//     flexDirection: 'row',
//     justifyContent: 'center',
//     alignItems: 'center',
//     height: 56,
//     marginTop: 40,
//   },

//   contactButtonText: {
//     fontFamily: 'Nunito_800ExtraBold',
//     color: '#FFF',
//     fontSize: 16,
//     marginLeft: 16,
//   }
// });