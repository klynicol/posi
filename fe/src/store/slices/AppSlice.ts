import { createSlice, PayloadAction } from '@reduxjs/toolkit';
import { BaseCodeDescription } from '../../base/types';

export interface ClientSettings {
    checkoutGridItemDisplayType: BaseCodeDescription
}

export interface AppSettings {

}

export interface AppState {
    bottomNavIndex: number | null
    clientSettings?: ClientSettings
    appSettings?: AppSettings
}

const initialState: AppState = {
    bottomNavIndex: null,
}

export const appSlice = createSlice({
    name: 'navigation',
    initialState,
    reducers: {
        setClientSettings: (state: AppState, action: PayloadAction<ClientSettings>) => {
            state.clientSettings = action.payload
        },
        setAppSettings: (state: AppState, action: PayloadAction<AppSettings>) => {
            state.appSettings = action.payload
        }
    }
});

export const {
    setClientSettings,
    setAppSettings,
} = appSlice.actions

export default appSlice.reducer
