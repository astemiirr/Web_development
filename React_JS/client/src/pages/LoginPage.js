import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

const LoginPage = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();
  const { login } = useAuth();

  const handleSubmit = (e) => {
    e.preventDefault();
    setError('');
    
    if (login(username, password)) {
      navigate('/products');
    } else {
      setError('Неверное имя пользователя или пароль');
    }
  };

  const handleDemoLogin = () => {
    setUsername('admin');
    setPassword('admin');
  };

  return (
    <div style={styles.container}>
      <div style={styles.card}>
        <h2>Вход в систему</h2>
        
        <form onSubmit={handleSubmit} style={styles.form}>
          <div style={styles.formGroup}>
            <label>Имя пользователя</label>
            <input
              type="text"
              value={username}
              onChange={(e) => setUsername(e.target.value)}
              style={styles.input}
              required
            />
          </div>
          
          <div style={styles.formGroup}>
            <label>Пароль</label>
            <input
              type="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              style={styles.input}
              required
            />
          </div>
          
          {error && <div style={styles.error}>{error}</div>}
          
          <button type="submit" style={styles.button}>
            Войти
          </button>
        </form>
        
        <button 
          onClick={handleDemoLogin} 
          style={styles.demoButton}
        >
          Заполнить тестовые данные
        </button>
        
        <p style={styles.hint}>
          Подсказка: используйте admin/admin для входа
        </p>
      </div>
    </div>
  );
};

const styles = {
  container: {
    display: 'flex',
    justifyContent: 'center',
    alignItems: 'center',
    minHeight: '60vh'
  },
  card: {
    backgroundColor: 'white',
    padding: '2rem',
    borderRadius: '8px',
    boxShadow: '0 2px 8px rgba(0,0,0,0.1)',
    width: '100%',
    maxWidth: '400px'
  },
  form: {
    marginTop: '1.5rem'
  },
  formGroup: {
    marginBottom: '1rem'
  },
  input: {
    width: '100%',
    padding: '0.75rem',
    border: '1px solid #ddd',
    borderRadius: '4px',
    fontSize: '1rem'
  },
  button: {
    width: '100%',
    padding: '0.75rem',
    backgroundColor: '#2ecc71',
    color: 'white',
    border: 'none',
    borderRadius: '4px',
    fontSize: '1rem',
    cursor: 'pointer',
    marginTop: '1rem'
  },
  demoButton: {
    width: '100%',
    padding: '0.75rem',
    backgroundColor: '#3498db',
    color: 'white',
    border: 'none',
    borderRadius: '4px',
    fontSize: '1rem',
    cursor: 'pointer',
    marginTop: '1rem'
  },
  error: {
    color: '#e74c3c',
    marginTop: '0.5rem'
  },
  hint: {
    marginTop: '1rem',
    color: '#7f8c8d',
    fontSize: '0.9rem',
    textAlign: 'center'
  }
};

export default LoginPage;
