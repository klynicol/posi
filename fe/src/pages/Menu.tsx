import {
  BanknotesIcon, BellAlertIcon, CalculatorIcon, ChartBarIcon,
  Cog6ToothIcon, ListBulletIcon, ShoppingBagIcon, TagIcon, UserCircleIcon
} from "@heroicons/react/24/outline";
import BottomNav from "../components/BottomNav";
import { BOTTOM_NAV_HEIGHT } from "../constants";

const menuItemIconSize = 20;


interface MenuItemProps {
  icon: React.ReactNode;
  title: string;
}

const MenuItem = (props: MenuItemProps) => {
  return (
    <a href="" className="hover:text-slate-700">
      <span>
        {props.icon}
      </span>
      <span>
        {props.title}
      </span>
    </a>
  );
}

const menuItems = [
  {
    icon: <ShoppingBagIcon width={menuItemIconSize} height={menuItemIconSize} />,
    title: 'Orders',
  },
  {
    icon: <UserCircleIcon width={menuItemIconSize} height={menuItemIconSize} />,
    title: 'Team',
  },
  {
    icon: <CalculatorIcon width={menuItemIconSize} height={menuItemIconSize} />,
    title: 'Invoices',
  },
  {
    icon: <BanknotesIcon width={menuItemIconSize} height={menuItemIconSize} />,
    title: 'Balance',
  },
  {
    icon: <ChartBarIcon width={menuItemIconSize} height={menuItemIconSize} />,
    title: 'Reports',
  },
  {
    icon: <BellAlertIcon width={menuItemIconSize} height={menuItemIconSize} />,
    title: 'Support',
  },
  {
    icon: <TagIcon width={menuItemIconSize} height={menuItemIconSize} />,
    title: 'Items',
  },
  {
    icon: <Cog6ToothIcon width={menuItemIconSize} height={menuItemIconSize} />,
    title: 'Settings',
  },
  {
    icon: <ListBulletIcon width={menuItemIconSize} height={menuItemIconSize} />,
    title: 'Customers',
  },
]

interface MenuProps {

}

const Menu = (props: MenuProps) => {
  return (

    <div className="flex flex-col justify-center items-center h-full">
      <div className='flex flex-col justify-between items-center flex-grow'>
        <h2 className="text-left mb-16">Welcome Back</h2>
        <div>
          <h3>Mark Wickline</h3>
          <div>
            {menuItems.map((item, index) => (
              <MenuItem key={index} icon={item.icon} title={item.title} />
            ))}
          </div>
        </div>
        <BottomNav />
      </div>
      <div style={{ height: BOTTOM_NAV_HEIGHT, width: '100%' }}></div>
    </div>

  );
}

export default Menu;