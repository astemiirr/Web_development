const HomePage = () => {
    return (
        <div style={styles.container}>
            {/* Герой-секция с изображением */}
            <div style={styles.hero}>
                <img 
                    src="/images/homepage.png" 
                    alt="Фруктовый сад" 
                    style={styles.heroImage}
                />
                <div style={styles.heroOverlay}>
                    <h1 style={styles.heroTitle}>🍎 Магазин свежих фруктов</h1>
                    <p style={styles.heroSubtitle}>Самые свежие фрукты прямо с фермы</p>
                </div>
            </div>

            {/* Контент */}
            <div style={styles.content}>
                <h2>Добро пожаловать!</h2>
                <p>У нас вы найдете самые свежие и качественные фрукты.</p>
                
                <div style={styles.features}>
                    <div style={styles.feature}>
                        <h3>🚚 Быстрая доставка</h3>
                        <p>Доставим в течение дня</p>
                    </div>
                    <div style={styles.feature}>
                        <h3>🌟 Гарантия качества</h3>
                        <p>Только свежие продукты</p>
                    </div>
                    <div style={styles.feature}>
                        <h3>💰 Лучшие цены</h3>
                        <p>Прямые поставки</p>
                    </div>
                </div>
                
                <div style={styles.authInfo}>
                    <p>Для просмотра каталога войдите в систему</p>
                    <p style={styles.credentials}>Тестовые данные: <strong>admin / admin</strong></p>
                </div>
            </div>
        </div>
    );
};

const styles = {
    container: {
        minHeight: '100vh'
    },
    hero: {
        position: 'relative',
        height: '400px',
        overflow: 'hidden'
    },
    heroImage: {
        width: '100%',
        height: '100%',
        objectFit: 'cover'
    },
    heroOverlay: {
        position: 'absolute',
        top: 0,
        left: 0,
        right: 0,
        bottom: 0,
        backgroundColor: 'rgba(0, 0, 0, 0.5)',
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        justifyContent: 'center',
        color: 'white',
        textAlign: 'center',
        padding: '20px'
    },
    heroTitle: {
        fontSize: '2.5rem',
        marginBottom: '1rem'
    },
    heroSubtitle: {
        fontSize: '1.2rem',
        opacity: 0.9
    },
    content: {
        maxWidth: '1200px',
        margin: '0 auto',
        padding: '2rem'
    },
    features: {
        display: 'grid',
        gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))',
        gap: '2rem',
        margin: '3rem 0'
    },
    feature: {
        padding: '1.5rem',
        backgroundColor: '#f8f9fa',
        borderRadius: '8px',
        textAlign: 'center'
    },
    authInfo: {
        textAlign: 'center',
        padding: '2rem',
        backgroundColor: '#e8f5e9',
        borderRadius: '8px',
        marginTop: '2rem'
    },
    credentials: {
        marginTop: '1rem',
        color: '#2e7d32'
    }
};

export default HomePage;
