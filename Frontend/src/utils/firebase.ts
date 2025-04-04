// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyBD8fQYBgpboKr0e8rlvrnE9v1frHzvj1k",
  authDomain: "inventario-equipos-61a16.firebaseapp.com",
  projectId: "inventario-equipos-61a16",
  storageBucket: "inventario-equipos-61a16.firebasestorage.app",
  messagingSenderId: "69342939340",
  appId: "1:69342939340:web:627e3cbba681f949cb1a69"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
export default app