/**
 * File should not be used in production.
 * It should be used as a copy paste helper when creating new slices
 */

import { createSlice, PayloadAction } from '@reduxjs/toolkit';

export interface NavigationState {
    bottomNavIndex: number | null
}

const initialState: NavigationState = {
    bottomNavIndex: null
}

export const navigationSlice = createSlice({
    name: 'navigation',
    initialState,
    reducers: {
        setBottomNavIndex: (state: NavigationState, action: PayloadAction<number>) => {
            state.bottomNavIndex = action.payload
        },
    }
});

export const {
    setBottomNavIndex
} = navigationSlice.actions

export default navigationSlice.reducer