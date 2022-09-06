import React from 'react';
import { View, StyleSheet, Text, TouchableOpacity } from 'react-native';
import { Feather } from '@expo/vector-icons';
import { useNavigation } from '@react-navigation/native';

interface HeaderProps {
  title: string;
}

export default function Header({ title }: HeaderProps) {
  const navigation = useNavigation();

  return (
    <View style={styles.container}>
      <TouchableOpacity onPress={navigation.goBack}>
        <Feather name='arrow-left' size={24} color='rgba(0, 0, 0, 0.6)' />
      </TouchableOpacity>

      <Text style={styles.title}>{title}</Text>

      <View />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    // flex: 1,
    padding: 24,
    backgroundColor: 'rgba(0, 0, 0, 0)',
    borderBottomWidth: 1,
    borderColor: 'rgba(0, 0, 0, 0.09)',
    paddingTop: 44,
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },

  title: {
    fontFamily: 'Nunito_600SemiBold',
    color: '#8fa7b3',
    fontSize: 16,
  },
});