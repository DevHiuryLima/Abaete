import React from 'react';
import { View, StyleSheet, Text, Image, TouchableOpacity } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { useNavigation } from '@react-navigation/native';

import greenQuizIcon from '../../src/images/Quiz/greenQuizIcon.png';

interface HeaderProps {
  title: string;
}

export default function Header({ title }: HeaderProps) {
  const navigation = useNavigation();

  return (
    <View style={styles.container}>
      {/* <View /> */}
      <TouchableOpacity onPress={navigation.goBack}>
        <Feather name='arrow-left' size={24} color='rgba(0, 0, 0, 0.6)' />
      </TouchableOpacity>

      <View style={styles.containerTitle}>
        <Text style={styles.title}>
          {title}
        </Text>
        <Image source={greenQuizIcon} style={styles.quizIcon}/>
      </View>

      <View />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    // flex: 1,
    padding: 14,
    backgroundColor: 'rgba(0, 0, 0, 0)',
    borderBottomWidth: 1,
    borderColor: 'rgba(0, 0, 0, 0.09)',
    paddingTop: 44,
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },

  containerTitle: {
    // flex: 1,
    flexDirection: 'row',    
  },

  title: {
    fontFamily: 'Nunito_600SemiBold',
    color: '#8fa7b3',
    fontSize: 24,
  },

  quizIcon: {
    width: 12,
    height: 12,
  }
});