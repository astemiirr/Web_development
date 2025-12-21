import React from 'react';
import useServerGoods from '../hooks/useServerGoods';
import ProductCard from '../components/ProductCard';

const ProductsPage = () => {
    const { products, loading, error, hasMore, loadMore, retry } = useServerGoods();

    return (
        <div style={styles.container}>
            <h1 style={styles.title}>Каталог фруктов</h1>
            <p style={styles.subtitle}>Свежие фрукты каждый день</p>
            
            {loading && products.length === 0 ? (
                <div style={styles.message}>Загрузка...</div>
            ) : error ? (
                <div style={styles.errorContainer}>
                    <div style={styles.error}>Ошибка соединения</div>
                    <button onClick={retry} style={styles.retryButton}>
                        Попробовать снова
                    </button>
                </div>
            ) : (
                <>
                    <div style={styles.grid}>
                        {products.map(product => (
                            <ProductCard key={product.id} product={product} />
                        ))}
                    </div>
                    
                    {loading && products.length > 0 && (
                        <div style={styles.message}>Загрузка...</div>
                    )}
                    
                    {hasMore && !loading && (
                        <button 
                            onClick={loadMore} 
                            style={styles.loadMoreButton}
                        >
                            Загрузить больше
                        </button>
                    )}
                    
                    {!hasMore && products.length > 0 && (
                        <div style={styles.message}>Все товары загружены</div>
                    )}
                </>
            )}
        </div>
    );
};

const styles = {
    container: {
        padding: '20px',
        maxWidth: '1400px',
        margin: '0 auto'
    },
    title: {
        textAlign: 'center',
        color: '#2c3e50',
        fontSize: '2.5rem',
        marginBottom: '0.5rem'
    },
    subtitle: {
        textAlign: 'center',
        color: '#718096',
        fontSize: '1.1rem',
        marginBottom: '40px'
    },
    grid: {
        display: 'grid',
        gridTemplateColumns: 'repeat(auto-fill, minmax(300px, 1fr))',
        gap: '30px',
        marginBottom: '40px'
    },
    loadMoreButton: {
        display: 'block',
        margin: '2rem auto',
        padding: '1rem 2rem',
        backgroundColor: '#2ecc71',
        color: 'white',
        border: 'none',
        borderRadius: '4px',
        fontSize: '1rem',
        cursor: 'pointer',
        transition: 'background-color 0.2s'
    },
    retryButton: {
        padding: '10px 20px',
        backgroundColor: '#e74c3c',
        color: 'white',
        border: 'none',
        borderRadius: '4px',
        cursor: 'pointer'
    },
    message: {
        textAlign: 'center',
        padding: '20px',
        color: '#7f8c8d',
        fontSize: '18px'
    },
    error: {
        textAlign: 'center',
        padding: '20px',
        color: '#e74c3c',
        fontSize: '18px',
        marginBottom: '10px'
    },
    errorContainer: {
        textAlign: 'center',
        padding: '40px'
    }
};

export default ProductsPage;
