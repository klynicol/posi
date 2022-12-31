import { Route, Routes } from 'react-router-dom'
import './App.scss'
import Checkout from './pages/Checkout';
import Menu from './pages/Menu';

function App() {

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
