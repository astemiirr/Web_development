import React from 'react';
import { Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

const Header = () => {
  const { isAuthenticated, logout } = useAuth();

  return (
    <header style={styles.header}>
      <div style={styles.container}>
        <Link to="/" style={styles.logo}>
          🍎 Fruit Shop
        </Link>
        
        <nav style={styles.nav}>
          <Link to="/" style={styles.navLink}>Главная</Link>
          
          {isAuthenticated ? (
            <>
              <Link to="/products" style={styles.navLink}>Товары</Link>
              <button onClick={logout} style={styles.logoutBtn}>
                Выйти
              </button>
            </>
          ) : (
            <Link to="/login" style={styles.navLink}>Войти</Link>
          )}
        </nav>
      </div>
    </header>
  );
};

const styles = {
  header: {
    backgroundColor: '#2ecc71',
    color: 'white',
    padding: '1rem 0',
  },
  container: {
    maxWidth: '1200px',
    margin: '0 auto',
    padding: '0 1rem',
    display: 'flex',
    justifyContent: 'space-between',
    alignItems: 'center'
  },
  logo: {
    fontSize: '1.5rem',
    fontWeight: 'bold',
    color: 'white',
    textDecoration: 'none'
  },
  nav: {
    display: 'flex',
    alignItems: 'center',
    gap: '1.5rem'
  },
  navLink: {
    color: 'white',
    textDecoration: 'none'
  },
  logoutBtn: {
    background: 'none',
    border: '1px solid white',
    color: 'white',
    padding: '0.5rem 1rem',
    borderRadius: '4px',
    cursor: 'pointer'
  }
};

export default Header;
