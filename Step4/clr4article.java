import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;
import org.json.simple.JSONObject;
import org.json.simple.JSONArray;

public class clr4article {

    /**
     * This application is built to clear the data in json file which the object
     * has no author.
     *
     * @author YilongWu (A00429725)
     */
        public static void main(String[] args) {
        //  
        try {
            BufferedReader br = new BufferedReader(new FileReader(
                    "./articles.json"));//
            BufferedWriter bw = new BufferedWriter(new FileWriter(
                    "./ARTICLE.json"));// 
            String s = null, ws = null;
            int id = 10000000;

            JSONParser parser = new JSONParser();
            bw.write("[\n");

            JSONArray a = (JSONArray) parser.parse(new FileReader("./articles.json"));
            for (int i = 0; i < a.size() - 1; i++) {
                try {

                    JSONObject article = (JSONObject) a.get(i);
                    JSONArray authors = (JSONArray) article.get("author");
                    String title = (String) article.get("title");
                    String journal = (String) article.get("journal");
                    String volume = (String) article.get("volume");
                    String year = (String) article.get("year");
                    String pages = (String) article.get("number");

                    if (!title.startsWith("{") && !journal.startsWith("{") 
                            && !volume.startsWith("{") && !year.startsWith("{") 
                            && !pages.startsWith("{")) {

                        if (authors.size() != 0) {
                            bw.write("    {");
                            bw.newLine();
                            bw.write("        \"Article_id\":\"" + id + "\",\n");
                            id++;
                                                        title=title.replace("\\", "");
                                                        journal=journal.replace("\\", "");
                            bw.write("        \"Title\": \"" + title.replace("\"", "'") + "\",\n");
                            bw.write("        \"Journal\": \"" + journal.replace("\"", "'") + "\",\n");
                            bw.write("        \"Volume\": \"" + volume + "\",\n");
                            bw.write("        \"Year\": \"" + year + "\",\n");
                            bw.write("        \"Pages\": \"" + pages + "\",\n");
                            bw.write("        \"Authors\": [\n");
                            for (int j = 0; j < authors.size() - 1; j++) {
                                bw.write("          \"" + authors.get(j).toString().replace("\"","'") + "\",");
                                bw.newLine();
                            }
                            bw.write("          \"" + authors.get(authors.size() - 1).toString().replace("\"","'") + "\"");
                            bw.newLine();
                            bw.write("        ]");
                            bw.newLine();

                            bw.write("    },");
                            bw.newLine();
                        }
                    }
                } catch (RuntimeException e) {
                    e.printStackTrace();
                }
            }
            JSONObject article = (JSONObject) a.get(a.size() - 1);
            JSONArray authors = (JSONArray) article.get("author");

            if (authors.size() != 0) {
                bw.write("    {");
                bw.newLine();
                bw.write("        \"Article_id\":\"" + id + "\",");

                bw.newLine();
                id++;

                String title = (String) article.get("title");
                bw.write("        \"Title\": \"" + title + "\",");
                bw.newLine();
                String journal = (String) article.get("journal");
                bw.write("        \"Journal\": \"" + journal + "\",");
                bw.newLine();
                String volume = (String) article.get("volume");
                bw.write("        \"Volumn\": \"" + volume + "\",");
                bw.newLine();
                String year = (String) article.get("year");
                bw.write("        \"Year\": \"" + year + "\",");
                bw.newLine();
                String pages = (String) article.get("number");
                bw.write("        \"Pages\": \"" + pages + "\",");
                bw.newLine();

                bw.write("        \"Authors\": [");
                bw.newLine();
                for (int j = 0; j < authors.size() - 1; j++) {
                    bw.write("          \"" + authors.get(j) + "\",");
                    bw.newLine();
                }
                bw.write("          \"" + authors.get(authors.size() - 1) + "\"");
                bw.newLine();
                bw.write("        ]");
                bw.newLine();

                bw.write("    }");
                bw.newLine();
                bw.write("]");

                bw.flush();
                br.close();
                bw.close();
            }

        } catch (ParseException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }

    }

}