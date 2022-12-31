import { configureStore, ThunkAction, Action } from "@reduxjs/toolkit";
import navigationSliceReducer from "./slices/NavigationSlice";

export const store = configureStore({
  reducer: {
    navigation: navigationSliceReducer,
  },
});

export type AppDispatch = typeof store.dispatch;
export type RootState = ReturnType<typeof store.getState>;
export type AppThunk<ReturnType = void> = ThunkAction<
  ReturnType,
  RootState,
  unknown,
  Action<string>
>;