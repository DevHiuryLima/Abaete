import React, { useEffect, useState } from 'react';
import { Image, ScrollView, View, StyleSheet, Text, TouchableOpacity, Dimensions } from 'react-native';
import { useNavigation, useRoute } from '@react-navigation/native';
import { CheckBox } from '@rneui/themed/dist/CheckBox/index';
// import { CheckBox } from 'react-native-elements'
import { v4 as uuidv4 } from 'uuid';

import * as ImagePicker from 'expo-image-picker';
import api from '../../services/api';
import homeBackground from '../../images/Quiz/perfil.jpg';
import lightSeaBlueRankingIcon from '../../images/Quiz/lightSeaBlueRankingIcon.png';
import levelUpQuizIcon from '../../images/Quiz/levelUpQuizIcon.png';
import level from '../../images/Quiz/level.png';

interface UsuarioRouteParams {
  id: number;
}

interface Usuario {
  idUsuario: number;
  nome: string;
  imagem: string;
  email: string;
  senha: string;
  ultima_tentativa: Date;
  created_at: string;
  updated_at: string;
  url: string;
  pontuacao: {
		idPontoUsuario: number;
		usuario: number;
		pontos: number;
	};
}

interface Quiz {
  idQuiz: number;
  terra: number;
  tipo: string;
  pergunta: string;
  alternativa_a: string; 
  alternativa_b: string; 
  alternativa_c: string; 
  alternativa_correta: string; 
  verdadeiro_falso: string; 
  pontos: string; 
  created_at: string;
  updated_at: string;
};

export default function Quiz() {
  const route = useRoute();
  const navigation = useNavigation();

  // Estados relacionado ao elementos da tela.
  const [quiz, setQuiz] = useState<Quiz>();
  const [usuario, setUsuario] = useState<Usuario | null>(null);

  // Estados relacionado ao elementos da tela -> checkbox.
  const [alternativa_a, setAlternativa_a] = useState(false);
  const [alternativa_b, setAlternativa_b] = useState(false);
  const [alternativa_c, setAlternativa_c] = useState(false);
  const [opcaoVerdadeiro, setOpcaoVerdadeiro] = useState<boolean>();
  const [opcaoFalso, setOpcaoFalso] = useState<boolean>();
  
  // Estados relacionado com a resposta do usário.
  const [alternativa_correta, setAlternativaCorreta] = useState<string>();
  const [verdadeiro_ou_falso, setVerdadeiroOuFalso] = useState<number>();

  // Gera uma nova data.
  const data = new Date();
  
  // Passa a nova data para o padrão ISO
  const dataAtual = new Date(data.toISOString());

  // Pega a data da ultima tentativa e acrescenta 1 dia.
  const proximaTentativa = new Date(usuario?.ultima_tentativa);
  proximaTentativa.setDate(proximaTentativa.getDate()+1);
  
  // Pega a diferença dessas duas datas
  var diff = proximaTentativa.getTime() - dataAtual.getTime();  

  // Separa quantas horas, minutos e segundos se passou.
  let tempoAux = diff;
  const horas = Math.floor(tempoAux / 1000 / 60 / 60);
  tempoAux -= horas * 1000 * 60 * 60;
  const minutos = Math.floor(tempoAux / 1000 / 60);
  tempoAux -= minutos * 1000 * 60;
  const segundos = Math.floor(tempoAux / 1000);
  tempoAux -= segundos * 1000;

  // Transformo as horas em segundos
  const [tempo, setTempo] = useState(Math.floor(1 * horas * 60 * 60));
  const [tentativa, setTentativa] = useState(false);

  const [horaEsquerda, horaDireita] = String(horas).padStart(2, '0').split('');
  const [minutoEsquerda, minutoDireita] = String(minutos).padStart(2, '0').split('');
  const [segundoEsquerda, segundoDireita] = String(segundos).padStart(2, '0').split('');

  const params = route.params as UsuarioRouteParams;

  useEffect(() => {
    api.get(`usuarios/${params.id}`).then(response => {
      setUsuario(response.data);
    }).catch((error) => {
      console.log(error);
    })
  }, [params.id, tentativa]);


  useEffect(() => {
    api.get(`quiz/busca`).then(response => {
      setQuiz(response.data);
    }).catch((error) => {
      console.log(error);
      console.log('\n');
      console.log(error.response);
      console.log('\n');
      console.log(error.response._response);
    })
  }, []);

  // useEffect(() => {
  //   if (tempo > 0) {
  //     setTimeout(() => {
  //       console.log('1 minuto ');
  //       setTempo(tempo - 1);
  //     }, 1000);
  //   }
  // }, [tempo]);

  const marcarA = () => {
    setAlternativa_a(true);
    setAlternativa_b(false);
    setAlternativa_c(false);
    setAlternativaCorreta('A');
  }

  const marcarB = () => {
    setAlternativa_a(false);
    setAlternativa_b(true);
    setAlternativa_c(false);
    setAlternativaCorreta('B');
  }

  const marcarC = () => {
    setAlternativa_a(false);
    setAlternativa_b(false);
    setAlternativa_c(true);
    setAlternativaCorreta('C');
  }

  const marcarVerdadeiro = () => {
    setOpcaoVerdadeiro(true);
    setOpcaoFalso(false);
    setVerdadeiroOuFalso(1);
  }

  const marcarFalso = () => {
    setOpcaoVerdadeiro(false);
    setOpcaoFalso(true);
    setVerdadeiroOuFalso(0);
  }

  function logout(){
    // navigation.reset({
    //   index: 0,
    //   routes: [{name: 'Login'}]
    // })

    // AsyncStorage.removeItem("TOKEN")

    navigation.navigate('Login');
  }

  function handleNavigateRanking() {
    navigation.navigate('Ranking');
  }

  async function responderPerguntas(){
    const dadosForm = new FormData();

    switch (quiz?.tipo) {
      case 'alternativas':

        dadosForm.append('idQuiz', quiz?.idQuiz);
        dadosForm.append('idUsuario', usuario?.idUsuario);
        dadosForm.append('alternativa_correta', alternativa_correta);

        break;

      case 'verdadeiro_ou_falso':

        dadosForm.append('idQuiz', quiz?.idQuiz);
        dadosForm.append('idUsuario', usuario?.idUsuario);
        dadosForm.append('verdadeiro_ou_falso', verdadeiro_ou_falso);
        
        break;
    
      default:
        return alert('Desculpe, ocorreu um problema ao validarmos sua resposta.');

        break;
    }

    // Gera uma nova data.
    let data = new Date();
    
    // Passa a nova data para o padrão ISO    
    let ultima_tentativa = data.toISOString();

    dadosForm.append('ultima_tentativa', ultima_tentativa);    

    try{
      // Envia a requisição pelos pseudônimos e após a criação de uma instância do axios.
      const response = await api.post('/quiz/responder', dadosForm);
      setTentativa(true);
      return alert(response.data.message);

    } catch (error) {

      // console.log(error);
      // console.log('\n');
      // console.log(error.response);
      // console.log('\n');
      // console.log(error.response._response);

      if(error.response.status === 0){
        return alert('Desculpe, ocorreu um problema de conexão ao validarmos sua resposta. Tente novamente mais tarde.');

      } else {
        return alert(error.response.data.message);
      }
    }
  }

  if(!usuario || !quiz) return (
    <View style={styles.container}>
      <Text style={styles.description}>Carregando...</Text>
    </View>
  );

  return (
    <ScrollView style={styles.container}>

      <View style={styles.containerPerfil}>
        <View style={styles.fieldRow}>
          <Image
            key={uuidv4()} 
            style={styles.image} 
            source={{ uri: usuario?.url + usuario?.imagem }} />

          <View style={styles.fieldColumn}>
            <Text style={styles.label}>{usuario?.nome}</Text>
            <Text style={styles.label}><Image source={level} style={styles.level}/> Pontos: {usuario?.pontuacao.pontos}</Text>
          </View>

          <TouchableOpacity style={styles.fieldColumn} onPress={handleNavigateRanking}>
            <Image
              key={uuidv4()} 
              style={styles.imageRanking} 
              source={lightSeaBlueRankingIcon} />
              <Text style={styles.labelRanking} >ver ranking</Text>
          </TouchableOpacity>
        </View>
      </View>


      <View style={styles.lineHorizontal} />



      {horas <= 0 ?

        <View style={styles.quizBox}>
          <View style={styles.quizBoxHeader}>
            <Text style={styles.quizBoxHeaderTitulo}>Nova pergunta!</Text>
          </View>

          <View style={styles.containerForm}>
            <Text style={styles.perguntas}>{quiz?.pergunta}</Text>
            
            {quiz?.tipo === 'alternativas' ?
              <>
                <CheckBox
                  key='S875AS5G7A5GA78SG5A8'
                  title='Alternativa A)'
                  center
                  checkedIcon="dot-circle-o"
                  uncheckedIcon="circle-o"
                  checked={alternativa_a}
                  onPress={marcarA}
                  style={styles.label}
                />
                <Text style={styles.label}>{quiz?.alternativa_a}</Text>

                <CheckBox
                  key='6A3G5SG377DG8A9ADG9'
                  title='Alternativa B)'
                  center
                  checkedIcon="dot-circle-o"
                  uncheckedIcon="circle-o"
                  checked={alternativa_b}
                  onPress={ marcarB}
                  style={styles.label}
                />
                <Text style={styles.label}>{quiz?.alternativa_b}</Text>
              
                <CheckBox
                  key='G96G9S4GA35G2A6763G'
                  title='Alternativa C)'
                  center
                  checkedIcon="dot-circle-o"
                  uncheckedIcon="circle-o"
                  checked={alternativa_c}
                  onPress={marcarC}
                  style={styles.label}
                />
                <Text style={styles.label}>{quiz?.alternativa_c}</Text>
              </>
            : 
              <>
                <CheckBox
                  key='6A3G5SG377DG8A9ADG9'
                  title='Verdadeiro'
                  center
                  checkedIcon="dot-circle-o"
                  uncheckedIcon="circle-o"
                  checked={opcaoVerdadeiro}
                  onPress={marcarVerdadeiro}
                  style={styles.label}
                />
                
                <CheckBox
                  key='G96G9S4GA35G2A6763G'
                  title='Falso'
                  center
                  checkedIcon="dot-circle-o"
                  uncheckedIcon="circle-o"
                  checked={opcaoFalso}
                  onPress={marcarFalso}
                  style={styles.label}
                />
              </>
            }


            <TouchableOpacity style={styles.loginButton} onPress={responderPerguntas}>
              <Text style={styles.loginButtonText}>Responder</Text>
            </TouchableOpacity>
          </View>
        </View>
      
      :

        <>
          <View style={styles.Countdown}>
            <View style={styles.CountdownContainerTitle}>
              <Text style={styles.title}>Tempo restante</Text>
            </View>

            <View style={styles.countdownContainer}>
              <View style={styles.CountdownCardsGroup}>
                <Text style={styles.CountdownCard}>{horaEsquerda}</Text>
              </View>

              <View style={styles.lineVertical}/>

              <View style={styles.CountdownCardsGroup}>
                <Text style={styles.CountdownCard}>{horaDireita}</Text>
              </View>

              <Text style={styles.CountdownSeparator}>:</Text>

              <View style={styles.CountdownCardsGroup}>
                <Text style={styles.CountdownCard}>{minutoEsquerda}</Text>
              </View>

              <View style={styles.lineVertical}/>

              <View style={styles.CountdownCardsGroup}>
                <Text style={styles.CountdownCard}>{minutoDireita}</Text>
              </View>

              {/* <Text style={styles.CountdownSeparator}>:</Text>

              <View style={styles.CountdownCardsGroup}>
                <Text style={styles.CountdownCard}>{segundoEsquerda}</Text>
              </View>

              <View style={styles.lineVertical}/>

              <View style={styles.CountdownCardsGroup}>
                <Text style={styles.CountdownCard}>{segundoDireita}</Text>
              </View> */}
            </View>

            <View style={styles.containerInformacoes}>
              <View>
                <Text style={styles.containerInformacoesText}>Horas</Text>
              </View>
              <View>
                <Text style={styles.containerInformacoesText}>Minutos</Text>
              </View>
              {/* <View>
                <Text style={styles.containerInformacoesText}>Segundos</Text>
              </View> */}
            </View>
          </View>

          <View style={styles.challengeBox}>
            <View style={styles.challengeNotActive}>
              <View style={styles.notActiveTitle}>
                <Text>
                  Aguarde um ciclo para receber uma questão
                </Text>
              </View>

              <View style={styles.levelUpQuizIcon}>
                <Image source={levelUpQuizIcon}/>
              </View>

              <View style={styles.notActiveSubTitle}>
                <Text>
                  Ganhe pontos respondendo as questões corretamente.
                </Text>
              </View>
            </View>
          </View>
        </>
      
      }
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFF',
  },

  description: {
    fontFamily: 'Nunito_600SemiBold',
    color: '#5c8599',
    lineHeight: 24,
    marginTop: 16,
  },

  // Perfil
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
    // backgroundColor: '#F2F3F5',

    borderRadius: 20,
    borderWidth: 1,
    borderColor: '#F2F3F5',
  },

  label: {
    color: '#8fa7b3',
    fontFamily: 'Nunito_600SemiBold',
    marginBottom: 8,
  },

  level: {
    width: 12,
    height: 12,
  },

  imageRanking: {
    width: 55,
    height: 55,
    resizeMode: 'cover',
  },

  labelRanking: {
    color: '#8fa7b3',
    fontFamily: 'Nunito_600SemiBold',
    fontSize: 11,
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
    // width: Dimensions.get('window').width,
  },

  title: {
    fontFamily: 'Nunito_600SemiBold',
    fontSize: 28,
    color: '#000',


    // Linha Linha Horizontal
    borderBottomColor: '#F2F3F5',
    borderBottomWidth: 1,
  },

  // CountDown -> Linha Horizontal
  lineHorizontal: {
    borderBottomColor: '#F2F3F5',
    borderBottomWidth: 1,
    height: 1,
  },

  countdownContainer: {
    // Feito com base no projeto do @sunderhus.
    flex: 1,
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center', 
    fontFamily: 'Nunito_600SemiBold', //'Rajdhani',
    margin: 8,
  },

  CountdownCardsGroup: {
    // Feito com base no projeto do @sunderhus.
    flex: 1,
    flexDirection: 'column', //Antes era 'row'.
    textAlign: 'center', // Isso não tinha
    alignItems: 'center', // Isso não tinha
    // justifyContent: 'space-evenly', // Comenteei esse
    backgroundColor: '#F2F3F5',
    boxShadow: '#000',
    borderRadius: 5,
  },

  CountdownCard: {
    // Feito com base no projeto do @sunderhus.
    fontSize: 82,
    color: '#000',
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

  containerInformacoes: {
    flex: 1,
    flexDirection: 'row',
    width: Dimensions.get('window').width,
    alignItems: 'center',
    justifyContent: 'space-around',
    textAlign: 'center',
  },

  containerInformacoesText: {
    // Linha Linha Horizontal
    borderBottomColor: '#F2F3F5',
    borderBottomWidth: 1,
  },




  // ChallengeBox
  challengeBox: {
    flex: 1,
    marginTop: 16,
    marginRight: 8,
    marginBottom: 16,
    marginLeft: 8,
    // backgroundColor: '#F2F3F5',
    borderWidth: 1,
    borderRadius: 5,
    borderColor: '#F2F3F5',
    paddingLeft: 10,
    paddingRight: 10,
    flexDirection: 'row',
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
    // flexDirection: 'row',
    color: '#000',
  },

  levelUpQuizIcon: {
    // position: 'absolute',
    width: 120,
    height: 120,
    justifyContent: 'center',
    alignItems: 'center',
  },

  notActiveSubTitle: {
    // flexDirection: 'row',
    alignItems: 'center',
    textAlign: 'center',
    // maxWidth: 70,
    marginTop: 16,
    // color: '#000',
  },

  // QuizBox
  quizBox: {
    flex: 1,
    marginTop: 16,
    marginRight: 8,
    marginBottom: 16,
    marginLeft: 8,
    // backgroundColor: '#F2F3F5',
    borderWidth: 1,
    borderRadius: 5,
    borderColor: '#F2F3F5',
    paddingLeft: 10,
    paddingRight: 10,
    flexDirection: 'column',
  },

  quizBoxHeader: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    flexDirection: 'column',
  },

  quizBoxHeaderTitulo: {
    fontFamily: 'Nunito_600SemiBold',
    fontSize: 28,
    color: '#000',

    // Linha Linha Horizontal
    borderBottomColor: '#F2F3F5',
    borderBottomWidth: 1,
  },

  containerForm: {
    flex: 1,
    // backgroundColor: '#FFFFFF',
    padding: 15,
  },

  perguntas: {
    textAlign: 'left',
    fontFamily: 'Nunito_600SemiBold',
    fontSize: 16,
    marginBottom: 16,
    // flexDirection: 'row',
    color: '#000',
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
});