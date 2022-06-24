import React, { useEffect, useState} from 'react';
import { StyleSheet, Text, View, Dimensions, TouchableOpacity } from 'react-native';
import MapView, { Marker, Callout, PROVIDER_GOOGLE } from 'react-native-maps';
import { Feather } from '@expo/vector-icons';
import { useNavigation, useRoute } from '@react-navigation/native';
import { RectButton } from 'react-native-gesture-handler';

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

// const response = [
//   {
//     "idTerra": 1,
//     "nome": "Avá-Canoeiro",
//     "populacao": "9 Pessoas",
//     "povos": "Avá-Canoeiro",
//     "lingua": "Tupi-Guarani",
//     "modalidade": "Tradicionalmente ocupada",
//     "sobre": "Até a década de 1960, o grupo era conhecido como “Canoeiro” na literatura, em razão da grande habilidade na utilização de canoas nos primórdios do contato com os colonizadores. Segundo Couto de Magalhães, que teve a oportunidade de recolher um vocabulário junto a um casal do grupo no Aldeamento Estiva, em 1863, quando era Presidente da Província de Goiás, os Canoeiro “tem esse nome, por se terem tornado célebres os seus ataques contra os navegantes do (Rio) Maranhão, a quem acometiam em levíssimas ubás e com agilidade tal, que chegavam sem ser pressentidos, retirando-se sem sofrer dano”. Os Avá-Canoeiro, como a maioria dos povos indígenas do Brasil, têm sua história marcada por massacres e uma quase extinção da etnia....",
//     "latitude": "-13.83516304",
//     "longitude": "-48.24298381",
//     "estado": "GO",
//     "created_at": "2022-06-10T16:57:13.000000Z",
//     "updated_at": "2022-06-10T16:57:13.000000Z",
//     "imagens_terra": [
//       {
//         "idImagem": 1,
//         "terra": 1,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/6haas5RZypwBBTX93rgzoAK8SEzSlsnOutcG8BCv.jpg",
//         "created_at": "2022-06-10T16:57:14.000000Z",
//         "updated_at": "2022-06-10T16:57:14.000000Z"
//       },
//       {
//         "idImagem": 2,
//         "terra": 1,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/6XaGxZQkdkml4ZzqHDFSpn9jNCVyQzT2kzLC5htc.jpg",
//         "created_at": "2022-06-10T16:57:14.000000Z",
//         "updated_at": "2022-06-10T16:57:14.000000Z"
//       },
//       {
//         "idImagem": 3,
//         "terra": 1,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/IjKgbSMfZm2y05qmt9t3jTNnVMEViXT90wkg3SvC.jpg",
//         "created_at": "2022-06-10T16:57:14.000000Z",
//         "updated_at": "2022-06-10T16:57:14.000000Z"
//       },
//       {
//         "idImagem": 4,
//         "terra": 1,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/w0Rio2F3Gph3s2RPQHytOD0EmWR3ztkIQgj54fPJ.jpg",
//         "created_at": "2022-06-10T16:57:14.000000Z",
//         "updated_at": "2022-06-10T16:57:14.000000Z"
//       },
//       {
//         "idImagem": 5,
//         "terra": 1,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/saopYpYPjVVzT2E9XK0YOLqBMJHSKawVtHSSFUK2.jpg",
//         "created_at": "2022-06-10T16:57:14.000000Z",
//         "updated_at": "2022-06-10T16:57:14.000000Z"
//       },
//       {
//         "idImagem": 6,
//         "terra": 1,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/kWv3hHrZG7RQ2CsEIjF85RnXbMD1zuem94JSB0K0.jpg",
//         "created_at": "2022-06-10T16:57:14.000000Z",
//         "updated_at": "2022-06-10T16:57:14.000000Z"
//       }
//     ]
//   },
//   {
//     "idTerra": 2,
//     "nome": "Carretão I",
//     "populacao": "197 Pessoas",
//     "povos": "Tapuia",
//     "lingua": "Não encontrado",
//     "modalidade": "Tradicionalmente ocupada",
//     "sobre": "Proveniente das políticas indigenistas que incidiram em Goiás mediante a prática de aldear para civilizar, domesticar, escravizar e pacificar, o povo Tapuia foi juntado forçadamente pela tática do aldeamento. Por esse tipo de tática de pressão territorial cumpria-se um objetivo: criar um modo rápido e sem defesa de desocupar as terras habitadas pelos povos indígenas.\r\n\r\nDessa feita, sua origem étnica está vinculada aos primeiros habitantes do aldeamento Carretão ou Pedro II, construído na região central da Província de Goiás, em 1788, para abrigar os índios Xavantes, Kaiapó do sul, Xerente, Karajá e Javaé e escravos negros e brancos.\r\n\r\nAo se estabelecer na terra com uma identidade forçada, o povo Tapuia sempre lutou por sua identidade étnica, tanto nas formas institucionais para o reconhecimento pelo Estado como \"índio\", como nas formas sociais, com a pretensão de ser respeitado como índio pela sociedade (3).\r\n\r\nQuando nos deparamos, à distância, com o seu modo de vida, num primeiro momento, a maneira como lida com a culinária, a paixão pelo futebol, o trato com a pecuária, com a agricultura e a prática de conversar em círculo, são elementos que podem nos conduzir a pensar que se trata apenas de uma arte de vida igual à do camponês goiano. Entretanto, quando nos aproximamos mais profundamente de seus valores e de sua organização, e vemos seu jeito de ligar-se ao tempo, o olhar profundo e demorado no ermo, às vezes desencantado, os traços corporais na pele, nos cabelos e o seu vasto saber sobre as espécies do Cerrado, enxergamos que se trata de um povo indígena especificado pelo aldeamento.",
//     "latitude": "-15.10906322",
//     "longitude": "-50.03994584",
//     "estado": "GO",
//     "created_at": "2022-06-10T17:44:23.000000Z",
//     "updated_at": "2022-06-10T17:44:23.000000Z",
//     "imagens_terra": [
//       {
//         "idImagem": 7,
//         "terra": 2,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/inqlH23nnB0bLBo8aJLPHSQuu8U19r5NDZqlJOu4.jpg",
//         "created_at": "2022-06-10T17:44:25.000000Z",
//         "updated_at": "2022-06-10T17:44:25.000000Z"
//       }
//     ]
//   },
//   {
//     "idTerra": 3,
//     "nome": "Carretão II",
//     "populacao": "162 Pessoas",
//     "povos": "Tapuia",
//     "lingua": "Não encontrado",
//     "modalidade": "Tradicionalmente ocupada",
//     "sobre": "Proveniente das políticas indigenistas que incidiram em Goiás mediante a prática de aldear para civilizar, domesticar, escravizar e pacificar, o povo Tapuia foi juntado forçadamente pela tática do aldeamento. Por esse tipo de tática de pressão territorial cumpria-se um objetivo: criar um modo rápido e sem defesa de desocupar as terras habitadas pelos povos indígenas. Dessa feita, sua origem étnica está vinculada aos primeiros habitantes do aldeamento Carretão ou Pedro II, construído na região central da Província de Goiás, em 1788, para abrigar os índios Xavantes, Kaiapó do sul, Xerente, Karajá e Javaé e escravos negros e brancos. Ao se estabelecer na terra com uma identidade forçada, o povo Tapuia sempre lutou por sua identidade étnica, tanto nas formas institucionais para o reconhecimento pelo Estado como \"índio\", como nas formas sociais, com a pretensão de ser respeitado como índio pela sociedade (3). Quando nos deparamos, à distância, com o seu modo de vida, num primeiro momento, a maneira como lida com a culinária, a paixão pelo futebol, o trato com a pecuária, com a agricultura e a prática de conversar em círculo, são elementos que podem nos conduzir a pensar que se trata apenas de uma arte de vida igual à do camponês goiano. Entretanto, quando nos aproximamos mais profundamente de seus valores e de sua organização, e vemos seu jeito de ligar-se ao tempo, o olhar profundo e demorado no ermo, às vezes desencantado, os traços corporais na pele, nos cabelos e o seu vasto saber sobre as espécies do Cerrado, enxergamos que se trata de um povo indígena especificado pelo aldeamento.",
//     "latitude": "-15.05621036",
//     "longitude": "-50.01865983",
//     "estado": "GO",
//     "created_at": "2022-06-10T17:52:26.000000Z",
//     "updated_at": "2022-06-10T17:52:26.000000Z",
//     "imagens_terra": [
//       {
//         "idImagem": 8,
//         "terra": 3,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/mQKFJfHufEzQLACQQs6J9SUtdbOl0c58MJ1RH3V8.jpg",
//         "created_at": "2022-06-10T17:52:27.000000Z",
//         "updated_at": "2022-06-10T17:52:27.000000Z"
//       }
//     ]
//   },
//   {
//     "idTerra": 4,
//     "nome": "Karajá de Aruanã I",
//     "populacao": "213 Pessoas",
//     "povos": "Iny Karajá",
//     "lingua": "Karajá",
//     "modalidade": "Tradicionalmente ocupada",
//     "sobre": "Em função da facilidade de navegação no rio Araguaia, desde o século XVI,\r\ndocumentos históricos mencionam o contato entre os Karajá e os não-índios, o que\r\ntorna a situação de exposição à cultura dita ocidental para além de quatro séculos (Lima\r\nFilho, 2006). Assim, os primeiros relatos sobre a localização desse povo aparecem no\r\nfinal desse século e os caracteriza como habitantes do baixo e médio curso do Araguaia.\r\nEssa datação representa a prova de que os Karajá nunca se afastaram daquilo que\r\nconsideram seu território tradicional: o rio Araguaia. (TORAL, 1992).\r\nO vínculo com o território tem origem no mito de origem que os apresenta como\r\no “povo do fundo rio” que se constitui, portanto, o útero fértil de onde se originaram\r\ntodos os Karajá. É o território da origem, do nascimento e do sentido da vida indígena.\r\nÉ nesse viés que é possível entender a relação profunda entre o Cerrado, com\r\ntudo que ele abarca, a fauna, a flora, a terra, as águas e os Karajá. Há um simbolismo\r\nque permeia as relações entre índios e Cerrado, entre seus elementos constitutivos e o\r\ndesenvolvimento da vida neste território que tradicionalmente era indígena. O Araguaia,\r\nportanto, constitui-se o território material e simbólico onde identidade indígena e\r\nterritório se misturam.\r\nPara os Karajá, portanto, o Araguaia e suas margens são permeados pelas\r\nhistórias dos entes que se foram e que marcaram suas identidades nos territórios que são\r\nconstantemente recriados e atualizados. Neste caso, o território é compreendido,\r\nconforme explicita Haesbaert (2005, p. 79), como uma “imbricação de múltiplas\r\nrelações de poder, do poder mais material das relações econômico-políticas ao poder\r\nmais simbólico das relações de ordem mais estritamente cultural”.",
//     "latitude": "-14.91661361",
//     "longitude": "-51.08216911",
//     "estado": "GO",
//     "created_at": "2022-06-10T18:04:12.000000Z",
//     "updated_at": "2022-06-10T18:04:12.000000Z",
//     "imagens_terra": [
//       {
//         "idImagem": 9,
//         "terra": 4,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/2tom4mC4rmeVjUxgEDo23cWGArWZvLXrxgdYpweU.jpg",
//         "created_at": "2022-06-10T18:04:13.000000Z",
//         "updated_at": "2022-06-10T18:04:13.000000Z"
//       },
//       {
//         "idImagem": 10,
//         "terra": 4,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/F1tdWC40zyBIACgKBBF4a7QOMK89khFlhc9FvF58.jpg",
//         "created_at": "2022-06-10T18:04:13.000000Z",
//         "updated_at": "2022-06-10T18:04:13.000000Z"
//       },
//       {
//         "idImagem": 11,
//         "terra": 4,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/8OtzbJTYHAQP9TqaCYsdYGdq9wNkm6QrDrskhIgL.jpg",
//         "created_at": "2022-06-10T18:04:13.000000Z",
//         "updated_at": "2022-06-10T18:04:13.000000Z"
//       },
//       {
//         "idImagem": 12,
//         "terra": 4,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/HV8XYUOMpZ0EM5d0ag3o5DKOCzcrcrsgwivGQuTC.jpg",
//         "created_at": "2022-06-10T18:04:13.000000Z",
//         "updated_at": "2022-06-10T18:04:13.000000Z"
//       }
//     ]
//   },
//   {
//     "idTerra": 5,
//     "nome": "Karajá de Aruanã III",
//     "populacao": "45 Pessoas",
//     "povos": "Iny Karajá",
//     "lingua": "Karajá",
//     "modalidade": "Tradicionalmente ocupada",
//     "sobre": "Em função da facilidade de navegação no rio Araguaia, desde o século XVI, documentos históricos mencionam o contato entre os Karajá e os não-índios, o que torna a situação de exposição à cultura dita ocidental para além de quatro séculos (Lima Filho, 2006). Assim, os primeiros relatos sobre a localização desse povo aparecem no final desse século e os caracteriza como habitantes do baixo e médio curso do Araguaia. Essa datação representa a prova de que os Karajá nunca se afastaram daquilo que consideram seu território tradicional: o rio Araguaia. (TORAL, 1992). O vínculo com o território tem origem no mito de origem que os apresenta como o “povo do fundo rio” que se constitui, portanto, o útero fértil de onde se originaram todos os Karajá. É o território da origem, do nascimento e do sentido da vida indígena. É nesse viés que é possível entender a relação profunda entre o Cerrado, com tudo que ele abarca, a fauna, a flora, a terra, as águas e os Karajá. Há um simbolismo que permeia as relações entre índios e Cerrado, entre seus elementos constitutivos e o desenvolvimento da vida neste território que tradicionalmente era indígena. O Araguaia, portanto, constitui-se o território material e simbólico onde identidade indígena e território se misturam. Para os Karajá, portanto, o Araguaia e suas margens são permeados pelas histórias dos entes que se foram e que marcaram suas identidades nos territórios que são constantemente recriados e atualizados. Neste caso, o território é compreendido, conforme explicita Haesbaert (2005, p. 79), como uma “imbricação de múltiplas relações de poder, do poder mais material das relações econômico-políticas ao poder mais simbólico das relações de ordem mais estritamente cultural”.",
//     "latitude": "-14.87805420",
//     "longitude": "-51.07996970",
//     "estado": "GO",
//     "created_at": "2022-06-10T18:10:22.000000Z",
//     "updated_at": "2022-06-10T18:10:22.000000Z",
//     "imagens_terra": [
//       {
//         "idImagem": 13,
//         "terra": 5,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/tLWGAFVEFitfY0A3DlWSpCJC5E57MdN08vBwhAG0.jpg",
//         "created_at": "2022-06-10T18:10:22.000000Z",
//         "updated_at": "2022-06-10T18:10:22.000000Z"
//       },
//       {
//         "idImagem": 14,
//         "terra": 5,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/CNB8pB5xWiDq4ms7Ipj2YBQFjFNHCRUVcjGiG6L5.jpg",
//         "created_at": "2022-06-10T18:10:22.000000Z",
//         "updated_at": "2022-06-10T18:10:22.000000Z"
//       },
//       {
//         "idImagem": 15,
//         "terra": 5,
//         "url": "http://localhost/Projects/Abaete/web/public/storage/imagens-terras/cWB0luBwonN30vjI5wsiFj9sInWGobPxQNxF8E04.jpg",
//         "created_at": "2022-06-10T18:10:22.000000Z",
//         "updated_at": "2022-06-10T18:10:22.000000Z"
//       }
//     ]
//   }
// ];

export default function MapaDeTerras() {
  const route = useRoute();
  // const [terras, setTerra] = useState([]);
  const [terras, setTerra] = useState<Terra[]>([]);
  const navigation = useNavigation();

  // console.log(terras.length);

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

          <TouchableOpacity style={styles.redirectQuizButton} onPress={() => {alert('Quiz')}}>
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