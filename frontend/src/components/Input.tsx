import Label from "./Label"
import Link from "./Link"

type InputProps = {
    value : string,
    handleValueChange : (e : any) => void,
    placeholder : string
    type : string
    id : string
    labelText : string
    onClick : () => void
    buttonText : string
}

const Input = ({ value , handleValueChange ,labelText, placeholder , type , id , onClick , buttonText} : InputProps) =>{
   return(
    <div className="mt-6 flex flex-col gap-y-4">
        <Label text={labelText} htmlFor={id} />
        <input
            type={type}
            id={id}
            value={value}
            onChange={handleValueChange}
            className="mt-1 p-2 w-full border border-gray-300 rounded-md"
            placeholder={placeholder}/>
        <Link onClick={onClick} text={buttonText} />
    </div>
    )
}

export default Input;