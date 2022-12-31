import { NavLink, useNavigate } from "react-router-dom";
import { AcademicCapIcon, Bars3Icon, TableCellsIcon } from "@heroicons/react/24/outline";
import { BOTTOM_NAV_HEIGHT } from "../constants";
import { useCallback, useState } from "react";
import { useAppDispatch, useAppSelector } from "../store/hook";
import { setBottomNavIndex } from "../store/slices/NavigationSlice";

interface BottomNavLinkProps {
  icon: React.ReactNode;
  grow?: boolean;
  className?: string;
  index: number;
  to: string
}

const BottomNavLink = (props: BottomNavLinkProps) => {
  const navigate = useNavigate();
  const activeIndex = useAppSelector(state => state.navigation.bottomNavIndex);
  const dispatch = useAppDispatch();

  const handleActiveButton = useCallback(() => {
    dispatch(setBottomNavIndex(props.index));
    navigate(props.to, { replace: true });
  }, [navigate]);

  // Is flex grow enabled?
  let dynClasses = props.grow === true ? 'flex-grow' : '';
  // Is a custom class name provided?
  dynClasses += props.className ? ` ${props.className}` : '';
  // Is the link active?
  dynClasses += props.index === activeIndex ? ' bg-slate-800' : ' bg-slate-600';

  return (
    <a className={`flex items-center justify-center 
    cursor-pointer hover:bg-slate-800 
    text-slate-300 ${dynClasses}`}
      onClick={handleActiveButton}>
      {props.icon}
    </a>
  );
};

interface BottomNavProps {

}

const BottomNav = (props: BottomNavProps) => {

  return (
    <div className="fixed bottom-0 w-full">
      <nav className='flex items-stretch justify-between'
        style={{ height: BOTTOM_NAV_HEIGHT }}>
        <BottomNavLink
          className="px-4"
          icon={<Bars3Icon width={30} height={30} />}
          index={0}
          to="/menu"
        />
        <div className="flex flex-grow">
          <BottomNavLink
            grow={true}
            icon={<AcademicCapIcon width={20} height={20} />}
            index={1}
          />
          <BottomNavLink
            grow={true}
            icon={<AcademicCapIcon width={20} height={20} />}
            index={2}
          />
          <BottomNavLink
            grow={true}
            icon={<AcademicCapIcon width={20} height={20} />}
            index={3}
          />
        </div>
        <BottomNavLink
          className="px-4"
          icon={<TableCellsIcon width={30} height={30} />}
          index={4}
        />
      </nav>
    </div>
  );
};

export default BottomNav;
