/**
 * File should not be used in production.
 * It should be used as a copy paste helper when creating new slices
 */

import { createSlice } from '@reduxjs/toolkit';

export interface UserState {
    isLoggedIn: boolean
}

const initialState: UserState = {
    isLoggedIn: false
}

export const userSlice = createSlice({
  name: 'user',
  initialState,
  reducers: {
    login: (state: UserState) => {
        state.isLoggedIn = true
    },
    logout: (state: UserState) => {
        state.isLoggedIn = false
    }
  }
});

export const { login, logout } = userSlice.actions

export default userSlice.reducer