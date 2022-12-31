import { CheckIcon } from "@heroicons/react/24/outline";
import { BOTTOM_NAV_HEIGHT } from "../constants";

interface CurrentSaleSidebarProps {

}

const CurrentSaleSidebar = (props: CurrentSaleSidebarProps) => {

  const charge = 0;
  return (
    <div className='fixed right-0 flex flex-col justify-between 
        w-1/4 h-full shadow-lg bg-white'
      style={{ paddingBottom: BOTTOM_NAV_HEIGHT }}>
      <div className='flex items-center justify-between h-20 border-b border-b-slate-300'>
        <span className="pl-3">
          Current Sale
        </span>
        <span className="pr-3">
          <CheckIcon width={20} height={20} />
        </span>
      </div>
      <div className="flex items-center justify-center h-12 bg-cyan-500">
        Charge ${charge}
      </div>
    </div>
  );
}

export default CurrentSaleSidebar;
