import { useState, useEffect, useCallback } from 'react';

const useServerGoods = (initialPage = 1, limit = 10) => {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [page, setPage] = useState(initialPage);
    const [hasMore, setHasMore] = useState(true);

    const fetchProducts = useCallback(async (pageNum) => {
        setLoading(true);
        setError(null);
        
        try {
            // Добавляем таймаут для демонстрации "Загрузка..."
            await new Promise(resolve => setTimeout(resolve, 300));
            
            // Используем абсолютный URL
            const response = await fetch(
                `http://localhost/api/fruits.php?page=${pageNum}&limit=${limit}`,
                {
                    mode: 'cors', // Явно указываем CORS
                    headers: {
                        'Accept': 'application/json',
                    }
                }
            );
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            if (pageNum === 1) {
                setProducts(data.products);
            } else {
                setProducts(prev => [...prev, ...data.products]);
            }
            
            setHasMore(data.hasMore);
            setPage(pageNum);
            
        } catch (err) {
            console.error('Ошибка при загрузке:', err);
            setError('Ошибка соединения с сервером');
        } finally {
            setLoading(false);
        }
    }, [limit]);

    const loadMore = () => {
        if (!loading && hasMore) {
            fetchProducts(page + 1);
        }
    };

    const retry = () => {
        fetchProducts(1);
    };

    useEffect(() => {
        fetchProducts(1);
    }, [fetchProducts]);

    return { 
        products, 
        loading, 
        error, 
        hasMore, 
        page,
        loadMore, 
        retry 
    };
};

export default useServerGoods;
