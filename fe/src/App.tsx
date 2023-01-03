import { ClientJS } from 'clientjs';
import { useEffect } from 'react';
import { Route, Routes } from 'react-router-dom'
import './App.scss'
import Checkout from './pages/Checkout';
import Menu from './pages/Menu';

function App() {

  useEffect(() => {
    // Get the client fingerprint and use it to load settings
    const client = new ClientJS();
    
  }, []);

  return (
    <div className="App h-screen">
      <Routes>
        <Route path="/" element={<Checkout/>} />
        <Route path="/menu" element={<Menu/> } />
      </Routes>
    </div>
  )
}

export default App;
