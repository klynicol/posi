import { useEffect } from "react";
import { ClientJS } from "clientjs";

interface CheckoutGridMenuProps {

}

const CheckoutGridMenu = (props: CheckoutGridMenuProps) => {
  return (
    <div className=''>
      CheckoutGridMenu Component
    </div>
  );
}

interface CheckoutGridItemProps {

}

const CheckoutGridItem = (props: CheckoutGridItemProps) => {
  


  return (
    <div className=''>
      CheckoutGridItem Component
    </div>
  );
}


interface CheckoutGridProps {

}

const CheckoutGrid = (props: CheckoutGridProps) => {

  useEffect(() => {
    const client = new ClientJS();
    console.log(client.getFingerprint());
  }, []);
  return (
    <div className=''>
      CheckoutGrid Component
    </div>
  );
}

export default CheckoutGrid;