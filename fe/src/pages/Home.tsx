import BottomNav from "../components/BottomNav";
import CurrentSaleSidebar from "../components/CurrentSaleSidebar";

interface HomeProps {
  
}

const Home = (props: HomeProps) => (
  <div className=''>
    <CurrentSaleSidebar/>
    <BottomNav />
  </div>
);

export default Home;