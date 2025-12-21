import { Link } from 'react-router-dom';

const ProductCard = ({ product }) => {
    return (
        <div style={styles.card}>
            <div style={styles.imageContainer}>
                <img 
                    src={`/images/fruits/${product.image}`} 
                    alt={product.name}
                    style={styles.image}
                    onError={(e) => {
                        e.target.style.display = 'none';
                        e.target.parentNode.innerHTML = `
                            <div style="
                                width: 100px; 
                                height: 100px; 
                                background: #2ecc71; 
                                border-radius: 50%; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center; 
                                color: white; 
                                font-size: 2rem; 
                                font-weight: bold;
                            ">
                                ${product.name.charAt(0)}
                            </div>
                        `;
                    }}
                />
            </div>
            
            <div style={styles.content}>
                <h3 style={styles.title}>{product.name}</h3>
                <p style={styles.category}>{product.category}</p>
                
                <div style={styles.details}>
                    <div style={styles.price}>{product.price} руб.</div>
                    <div style={styles.date}>{product.releaseDate}</div>
                </div>
                
                <p style={styles.description}>
                    {product.description.length > 60 
                        ? `${product.description.substring(0, 60)}...` 
                        : product.description}
                </p>
                
                <Link to={`/products/${product.id}`} style={styles.button}>
                    Подробнее
                </Link>
            </div>
        </div>
    );
};

const styles = {
    card: {
        backgroundColor: 'white',
        borderRadius: '12px',
        overflow: 'hidden',
        boxShadow: '0 4px 12px rgba(0,0,0,0.1)',
        transition: 'all 0.3s ease',
        height: '100%',
        display: 'flex',
        flexDirection: 'column'
    },
    imageContainer: {
        height: '200px',
        backgroundColor: '#f8f9fa',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        overflow: 'hidden'
    },
    image: {
        width: '100%',
        height: '100%',
        objectFit: 'cover',
        transition: 'transform 0.3s ease'
    },
    content: {
        padding: '1.5rem',
        flex: 1,
        display: 'flex',
        flexDirection: 'column'
    },
    title: {
        fontSize: '1.25rem',
        color: '#2d3748',
        marginBottom: '0.5rem'
    },
    category: {
        fontSize: '0.875rem',
        color: '#718096',
        marginBottom: '1rem'
    },
    details: {
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'center',
        marginBottom: '1rem'
    },
    price: {
        fontSize: '1.5rem',
        color: '#2ecc71',
        fontWeight: 'bold'
    },
    date: {
        fontSize: '0.875rem',
        color: '#718096'
    },
    description: {
        color: '#4a5568',
        fontSize: '0.95rem',
        lineHeight: 1.5,
        marginBottom: '1.5rem',
        flex: 1
    },
    button: {
        display: 'block',
        textAlign: 'center',
        padding: '0.75rem',
        backgroundColor: '#2ecc71',
        color: 'white',
        borderRadius: '6px',
        textDecoration: 'none',
        fontWeight: '500',
        transition: 'background-color 0.2s'
    }
};

export default ProductCard;
