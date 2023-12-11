
type Props = {
    onClick : () => void,  
    text : string
}

const Link = ({onClick , text}:Props)  => {
    return  <button onClick={onClick} className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{text}</button>
}

export default Link;