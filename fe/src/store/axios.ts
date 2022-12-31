import { useState, useEffect } from 'react';
import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from 'axios';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
//If you are using different URLs, consider removing this line and adding a baseURL in the Axios Config parameter. 

const useAxios = (axiosParams: AxiosRequestConfig | null = null) => {
  const [response, setResponse] = useState<AxiosResponse>();
  const [error, setError] = useState<AxiosError>();
  const [loading, setLoading] = useState(true);

  const fetchData = async (params: AxiosRequestConfig) => {
    try {
      const result = await axios.request(params);
      setResponse(result);
    } catch( err ) {
      setError(err as AxiosError);
    } finally {
      setLoading(false); 
    }
  };

  const sendData = (sendDataAxiosParams: AxiosRequestConfig | null = axiosParams) => {
    if(sendDataAxiosParams !== null){
      fetchData(sendDataAxiosParams);
    }
  }

  useEffect(() => {
    if(axiosParams !== null){
      fetchData(axiosParams);
    }
  },[]);

  return { response, error, loading, sendData };
}

export default useAxios;