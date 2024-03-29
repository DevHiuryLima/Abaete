import React from 'react';

import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';

const { Navigator, Screen } = createNativeStackNavigator();

import Home from './pages/Home/Home';
import Header from './components/Header';
import HeaderQuiz from './components/HeaderQuiz';
import MapaDeTerras from './pages/Terras/MapaDeTerras';
import ListarTerra from './pages/Terras/ListarTerra';
import CriarConta from './pages/Quizzes/CriarConta';
import Login from './pages/Quizzes/Login';
import Quiz from './pages/Quizzes/Quiz';
import Ranking from './pages/Quizzes/Ranking';

export default function Routes() {
  return (
    <NavigationContainer>
      <Navigator screenOptions={{ headerShown: false, headerStyle: { backgroundColor: '#f2f3f5', } }}>
        <Screen name='Home' component={Home}/>

        <Screen 
          name='MapaDeTerras' 
          component={MapaDeTerras}
        />

        <Screen 
          name='ListarTerra' 
          component={ListarTerra}
          options={{
            headerShown: true,
            header: () => <Header title='Terra índigena' />
          }}
        />

        <Screen 
          name='Login' 
          component={Login}
          options={{
            headerShown: true,
            header: () => <Header title='Login' />
          }}
        />
        
        <Screen 
          name='CriarConta' 
          component={CriarConta}
          options={{
            headerShown: true,
            header: () => <Header title='Criar conta' />
          }}
        />
        
        <Screen 
          name='Quiz' 
          component={Quiz}
          options={{
            headerShown: true,
            header: () => <HeaderQuiz title='Quiz' />
          }}
        />
        
        <Screen 
          name='Ranking' 
          component={Ranking}
          options={{
            headerShown: true,
            header: () => <Header title='Ranking' />
          }}
        />
      </Navigator>
    </NavigationContainer>
  );
}