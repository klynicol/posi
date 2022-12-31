import { NavLink } from "react-router-dom";
import { AcademicCapIcon, Bars3Icon, TableCellsIcon } from "@heroicons/react/24/outline";
import { BOTTOM_NAV_HEIGHT } from "../constants";
import { useState } from "react";

interface BottomNavLinkProps {
  icon: React.ReactNode;
  action: (index: number) => void;
  grow?: boolean;
  className?: string;
  index: number;
  activeIndex: number | null;
}

const BottomNavLink = (props: BottomNavLinkProps) => {

  // Is flex grow enabled?
  let dynClasses = !props.grow ? '' : 'flex-grow';
  // Is a custom class name provided?
  dynClasses += props.className ? ` ${props.className}` : '';
  // Is the link active?
  dynClasses += props.index === props.activeIndex ? ' bg-slate-800' : '';

  // Determine if the link is active and add the active class

  return (
    <a className={`flex items-center justify-center 
    cursor-pointer bg-slate-600 hover:bg-slate-800 
    text-slate-300 ${dynClasses}`}
      onClick={() => { props.action(props.index) }}>
      {props.icon}
    </a>
  );
};

interface BottomNavProps {

}

const BottomNav = (props: BottomNavProps) => {
  const [activeButton, setActiveButton] = useState<null | number>(null);

  const handleActiveButton = (index: number, callback = () => { }) => {
    setActiveButton(index);
    callback();
  };

  return (
    <div className="fixed bottom-0 w-full">
      <nav className='flex items-stretch justify-between'
        style={{ height: BOTTOM_NAV_HEIGHT }}>
        <BottomNavLink
          className="px-4"
          icon={<Bars3Icon width={30} height={30} />}
          index={0}
          activeIndex={activeButton}
          action={handleActiveButton}
        />
        <div className="flex flex-grow">
          <BottomNavLink
            grow={true}
            icon={<AcademicCapIcon width={20} height={20} />}
            index={1}
            activeIndex={activeButton}
            action={handleActiveButton}
          />
          <BottomNavLink
            grow={true}
            icon={<AcademicCapIcon width={20} height={20} />}
            index={2}
            activeIndex={activeButton}
            action={handleActiveButton}
          />
          <BottomNavLink
            grow={true}
            icon={<AcademicCapIcon width={20} height={20} />}
            index={3}
            activeIndex={activeButton}
            action={handleActiveButton}
          />
        </div>
        <BottomNavLink
          className="px-4"
          icon={<TableCellsIcon width={30} height={30} />}
          index={4}
          activeIndex={activeButton}
          action={handleActiveButton}
        />
      </nav>
    </div>
  );
};

export default BottomNav;
