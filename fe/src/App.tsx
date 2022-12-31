import { Route, Routes } from 'react-router-dom'
import './App.scss'
import Home from './pages/Home';
import Menu from './pages/Menu';

function App() {

  return (
    <div className="App h-screen">
      <Routes>
        <Route path="/" element={<Home/>} />
        <Route path="/menu" element={<Menu/> } />
      </Routes>
    </div>
  )
}

export default App;
