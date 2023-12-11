type LabelProps ={
    text : string
    htmlFor : string
}

const Label = ({text , htmlFor} : LabelProps) =>{
    return(
        <label htmlFor={htmlFor} className="block text-sm font-medium text-gray-600">
            {text}
        </label>
    )
}

export default Label;