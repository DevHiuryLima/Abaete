import React from 'react';

import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';

const { Navigator, Screen } = createNativeStackNavigator();

import MapaDeTerras from './pages/Terras/MapaDeTerras';
import ListarTerra from './pages/Terras/ListarTerra';
import Home from './pages/Home/Home';
import Header from './components/Header';

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
      </Navigator>
    </NavigationContainer>
  );
}