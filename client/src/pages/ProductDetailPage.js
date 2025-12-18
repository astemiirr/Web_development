import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';

const ProductDetailPage = () => {
    const { id } = useParams();
    const [product, setProduct] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        fetchProduct();
    }, [id]);

    const fetchProduct = async () => {
        try {
            const response = await fetch(`http://localhost/api/fruits.php?limit=30`);
            const data = await response.json();
            const foundProduct = data.products.find(p => p.id === parseInt(id));
            
            if (foundProduct) {
                setProduct(foundProduct);
            } else {
                setError('Товар не найден');
            }
        } catch (err) {
            setError('Ошибка соединения');
        } finally {
            setLoading(false);
        }
    };

    if (loading) return <div style={styles.message}>Загрузка...</div>;
    if (error) return <div style={styles.error}>{error}</div>;
    if (!product) return <div>Товар не найден</div>;

    return (
        <div style={styles.container}>
            <Link to="/products" style={styles.backLink}>
                ← Назад к списку
            </Link>
            
            <div style={styles.productDetail}>
                {/* Изображение товара */}
                <div style={styles.imageContainer}>
                    <img 
                        src={`/images/fruits/${product.image}`}
                        alt={product.name}
                        style={styles.image}
                        onError={(e) => {
                            e.target.style.display = 'none';
                            e.target.parentNode.innerHTML = `
                                <div style="
                                    width: 200px; 
                                    height: 200px; 
                                    background: #2ecc71; 
                                    border-radius: 50%; 
                                    display: flex; 
                                    align-items: center; 
                                    justify-content: center; 
                                    color: white; 
                                    font-size: 4rem; 
                                    font-weight: bold;
                                    margin: 0 auto;
                                ">
                                    ${product.name.charAt(0)}
                                </div>
                            `;
                        }}
                    />
                </div>
                
                <div style={styles.content}>
                    <h1 style={styles.title}>{product.name}</h1>
                    <p style={styles.category}>{product.category}</p>
                    
                    <div style={styles.price}>{product.price} руб.</div>
                    
                    <div style={styles.details}>
                        <div style={styles.detailItem}>
                            <span style={styles.detailLabel}>Дата выпуска:</span>
                            <span style={styles.detailValue}>{product.releaseDate}</span>
                        </div>
                        
                        <div style={styles.detailItem}>
                            <span style={styles.detailLabel}>ID товара:</span>
                            <span style={styles.detailValue}>{product.id}</span>
                        </div>
                    </div>
                    
                    <div style={styles.descriptionSection}>
                        <h3 style={styles.sectionTitle}>Описание</h3>
                        <p style={styles.description}>{product.description}</p>
                    </div>
                </div>
            </div>
        </div>
    );
};

const styles = {
    container: {
        maxWidth: '1000px',
        margin: '0 auto',
        padding: '2rem 1rem'
    },
    backLink: {
        display: 'inline-block',
        marginBottom: '2rem',
        color: '#2ecc71',
        textDecoration: 'none',
        fontSize: '1rem',
        padding: '0.5rem 1rem',
        border: '1px solid #2ecc71',
        borderRadius: '4px'
    },
    productDetail: {
        backgroundColor: 'white',
        borderRadius: '12px',
        padding: '2rem',
        boxShadow: '0 4px 12px rgba(0,0,0,0.1)',
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center'
    },
    imageContainer: {
        width: '300px',
        height: '300px',
        marginBottom: '2rem',
        overflow: 'hidden',
        borderRadius: '12px',
        backgroundColor: '#f8f9fa'
    },
    image: {
        width: '100%',
        height: '100%',
        objectFit: 'cover'
    },
    content: {
        width: '100%',
        maxWidth: '600px'
    },
    title: {
        fontSize: '2.5rem',
        color: '#2d3748',
        marginBottom: '0.5rem',
        textAlign: 'center'
    },
    category: {
        color: '#718096',
        fontSize: '1.1rem',
        marginBottom: '1.5rem',
        textAlign: 'center'
    },
    price: {
        color: '#2ecc71',
        fontSize: '2rem',
        fontWeight: 'bold',
        textAlign: 'center',
        marginBottom: '2rem'
    },
    details: {
        marginBottom: '2rem',
        padding: '1.5rem',
        backgroundColor: '#f8f9fa',
        borderRadius: '8px'
    },
    detailItem: {
        display: 'flex',
        justifyContent: 'space-between',
        marginBottom: '0.75rem',
        paddingBottom: '0.75rem',
        borderBottom: '1px solid #e2e8f0'
    },
    detailLabel: {
        color: '#718096',
        fontWeight: '500'
    },
    detailValue: {
        color: '#2d3748',
        fontWeight: '500'
    },
    descriptionSection: {
        marginTop: '2rem'
    },
    sectionTitle: {
        fontSize: '1.5rem',
        color: '#2d3748',
        marginBottom: '1rem'
    },
    description: {
        color: '#4a5568',
        lineHeight: '1.6',
        fontSize: '1.1rem'
    },
    message: {
        textAlign: 'center',
        padding: '40px',
        fontSize: '18px'
    },
    error: {
        textAlign: 'center',
        padding: '40px',
        color: 'red',
        fontSize: '18px'
    }
};

export default ProductDetailPage;
