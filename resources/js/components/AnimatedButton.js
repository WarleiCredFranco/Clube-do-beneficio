import React, { useState } from 'react';

const AnimatedButton = () => {
  const [isAnimating, setIsAnimating] = useState(false);

  const handleClick = () => {
    setIsAnimating(true);
    setTimeout(() => {
      setIsAnimating(false);
    }, 1000); // Defina o tempo de duração da animação aqui
  };

  return (
    <button
      className={`animated-button ${isAnimating ? 'animate' : ''}`}
      onClick={handleClick}
    >
      {isAnimating ? 'Aguarde...' : 'Clique em Mim'}
    </button>
  );
};

export default AnimatedButton;
